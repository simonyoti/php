<?php
namespace Yoti;

use compubapi_v1\EncryptedData;

/**
 * Class YotiClient
 *
 * @package Yoti
 * @author Simon Tong <simon.tong@yoti.com>
 *
 * todo: change staging url
 */
class YotiClient
{
    /**
     * outcomes
     */
    const OUTCOME_SUCCESS = 'SUCCESS';

    // default url for api (is passed in via constructor)
    const DEFAULT_CONNECT_API = 'https://api.yoti.com:443/api/v1';
//        const DEFAULT_CONNECT_API = 'https://staging0.api.yoti.com:8443/api/v1';

    // base url for connect page (user will be redirected to this page eg. baseurl/app-id)
    const CONNECT_BASE_URL = 'https://code.yoti.com/app';
//    const CONNECT_BASE_URL = 'https://staging0.www.yoti.com/connect';

    // dashboard login
    const DASHBOARD_URL = 'https://www.yoti.com/dashboard';
//    const DASHBOARD_URL = 'https://staging0.www.yoti.com/dashboard/login';

    /**
     * @var string
     */
    private $_connectApi;

    /**
     * @var string
     */
    private $_sdkId;

    /**
     * @var string
     */
    private $_pem;

    /**
     * @var array
     */
    private $_receipt;

    /**
     * @var bool
     */
    private $_mockRequests = false;

    /**
     * YotiClient constructor.
     * @param string $sdkId SDK Id from dashboard (not to be mistaken for App ID)
     * @param string $pem can be passed in as contents of pem file or file://<file> format or actual path
     * @param string $connectApi
     * @throws \Exception
     */
    public function __construct($sdkId, $pem, $connectApi = self::DEFAULT_CONNECT_API)
    {
        $requiredModules = ['curl', 'mcrypt', 'json'];
        foreach ($requiredModules as $mod)
        {
            if (!extension_loaded($mod))
            {
                throw new \Exception("PHP module '$mod' not installed");
            }
        }

        // check sdk id passed
        if (!$sdkId)
        {
            throw new \Exception("SDK ID is required");
        }

        // check pem passed
        if (!$pem)
        {
            throw new \Exception("PEM file is required");
        }

        // check if user passed pem as file path rather than file contents
        if (strpos($pem, 'file://') === 0 || file_exists($pem))
        {
            if (!file_exists($pem))
            {
                throw new \Exception("PEM file was not found.");
            }

            $pem = file_get_contents($pem);
        }

        // check key is valid
        if (!openssl_get_privatekey($pem))
        {
            throw new \Exception("PEM key is invalid");
        }

        $this->_sdkId = $sdkId;
        $this->_pem = $pem;
        $this->_connectApi = $connectApi;
    }

    /**
     * Get login url
     * @param string $appId
     * @return string
     */
    public static function getLoginUrl($appId)
    {
        return self::CONNECT_BASE_URL."/$appId";
    }

    /**
     * Set to test environment so it won't make requests to actual API
     * @param bool $toggle
     */
    public function setMockRequests($toggle = true)
    {
        $this->_mockRequests = $toggle;
    }

    /**
     * @return null
     */
    public function getOutcome()
    {
        return (array_key_exists('sharing_outcome', $this->_receipt)) ? $this->_receipt['sharing_outcome'] : null;
    }

    /**
     * @param null $encryptedConnectToken
     * @return \Yoti\ActivityDetails
     */
    public function getActivityDetails($encryptedConnectToken = null)
    {
        if (!$encryptedConnectToken && array_key_exists('token', $_GET))
        {
            $encryptedConnectToken = $_GET['token'];
        }

        $this->_receipt = $this->getReceipt($encryptedConnectToken);
        $encryptedData = $this->getEncryptedData($this->_receipt['other_party_profile_content']);
        $attributeList = $this->getAttributeList($encryptedData, $this->_receipt['wrapped_receipt_key']);

        // get profile
        $profile = ActivityDetails::constructFromAttributeList(
            $attributeList,
            array_key_exists('remember_me_id', $this->_receipt) ? $this->_receipt['remember_me_id'] : null
        );

        return $profile;
    }

    /**
     * @param $endpoint
     * @return string
     */
    private function getEndpointPath($endpoint)
    {
        // prepare message to sign
        $nonce = $this->generateNonce();
        $timestamp = round(microtime(true) * 1000);
        $path = "{$endpoint}?nonce={$nonce}&timestamp={$timestamp}&appId={$this->_sdkId}";

        return $path;
    }

    /**
     * @param $message
     * @return string
     */
    private function getSignedRequest($message)
    {
        openssl_sign($message, $signature, $this->_pem, OPENSSL_ALGO_SHA256);
        $messageSignature = base64_encode($signature);

        return $messageSignature;
    }

    /**
     * @param string $encryptedConnectToken
     * @return array
     * @throws \Exception
     */
    private function getReceipt($encryptedConnectToken)
    {
        // decrypt connect token
        $token = $this->decryptConnectToken($encryptedConnectToken);
        if (!$token)
        {
            throw new \Exception("Could not connect decrypt token.");
        }

        // get path for this endpoint
        $path = $this->getEndpointPath("/profile/$token");

        // sign request
        $messageSignature = $this->getSignedRequest("GET&{$path}");
        if (!$messageSignature)
        {
            throw new \Exception("Could not sign request.");
        }

        // get auth key
        $authKey = $this->getAuthKeyFromPem();
        if (!$authKey)
        {
            throw new \Exception("Could not retrieve key from PEM.");
        }

        // url to hit
        $url = $this->_connectApi . $path;

        // prepare headers
        $headers = [
            "X-Yoti-Auth-Key: $authKey",
            "X-Yoti-Auth-Digest: $messageSignature",
            "Content-Type: application/json",
            "Accept: application/json",
        ];

        // if !mockRequests then do the real thing
        if (!$this->_mockRequests)
        {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true,
            ]);
            $response = curl_exec($ch);

            // check response code
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode != 200)
            {
                throw new \Exception("Server responded with $httpCode");
            }
        }
        else
        {
            // sample receipt, don't make curl call instead spoof response from receipt.json
            $response = file_get_contents(__DIR__ . '/../sample-data/receipt.json');
        }

        // get json
        $json = json_decode($response, true);
        if (json_last_error() != JSON_ERROR_NONE)
        {
            throw new \Exception("JSON response was invalid");
        }

        // check receipt is in response
        if (!array_key_exists('receipt', $json))
        {
            throw new \Exception("Receipt not found in response");
        }

        return $json['receipt'];
    }

    /**
     * @return string
     */
    private function generateNonce()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * @return null|string
     */
    private function getAuthKeyFromPem()
    {
        $details = openssl_pkey_get_details(openssl_pkey_get_private($this->_pem));
        if (!array_key_exists('key', $details))
        {
            return null;
        }

        // remove BEGIN PUBLIC KEY / END PUBLIC KEY lines
        $key = trim($details['key']);
        $_key = explode(PHP_EOL, $key);
        if (strpos($key, 'BEGIN') !== false)
        {
            array_shift($_key);
            array_pop($_key);
        }
        $key = implode('', $_key);

        return $key;
    }

    /**
     * @param $encryptedConnectToken
     * @return mixed
     */
    private function decryptConnectToken($encryptedConnectToken)
    {
        $tok = base64_decode(strtr($encryptedConnectToken, '-_,', '+/='));
        openssl_private_decrypt($tok, $token, $this->_pem);

        return $token;
    }

    /**
     * @param $profileContent
     * @return \compubapi_v1\EncryptedData
     */
    private function getEncryptedData($profileContent)
    {
        // get cipher_text and iv
        $encryptedData = new \compubapi_v1\EncryptedData(base64_decode($profileContent));

        return $encryptedData;
    }

    /**
     * @param EncryptedData $encryptedData
     * @param $wrappedReceiptKey
     * @return \attrpubapi_v1\AttributeList
     */
    private function getAttributeList(EncryptedData $encryptedData, $wrappedReceiptKey)
    {
        // unwrap key and get profile
        openssl_private_decrypt(base64_decode($wrappedReceiptKey), $unwrappedKey, $this->_pem);

        // decipher encrypted data with unwrapped key and IV
        $cipherText = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $unwrappedKey, $encryptedData->getCipherText(), MCRYPT_MODE_CBC, $encryptedData->getIv());
        $padding = ord($cipherText[strlen($cipherText) - 1]);
        $decipheredData = substr($cipherText, 0, -$padding);

        // parse deciphered data into protobuf attribute list
        $attributeList = new \attrpubapi_v1\AttributeList($decipheredData);

        return $attributeList;
    }
}
