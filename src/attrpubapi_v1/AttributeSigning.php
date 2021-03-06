<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : Signing.proto
 */


namespace attrpubapi_v1;

/**
 * Protobuf message : attrpubapi_v1.AttributeSigning
 */
class AttributeSigning extends \Protobuf\AbstractMessage
{

    /**
     * @var \Protobuf\UnknownFieldSet
     */
    protected $unknownFieldSet = null;

    /**
     * @var \Protobuf\Extension\ExtensionFieldMap
     */
    protected $extensions = null;

    /**
     * name optional string = 1
     *
     * @var string
     */
    protected $name = null;

    /**
     * value optional bytes = 2
     *
     * @var \Protobuf\Stream
     */
    protected $value = null;

    /**
     * content_type optional enum = 3
     *
     * @var \attrpubapi_v1\ContentType
     */
    protected $content_type = null;

    /**
     * artifact_signature optional bytes = 4
     *
     * @var \Protobuf\Stream
     */
    protected $artifact_signature = null;

    /**
     * sub_type optional string = 5
     *
     * @var string
     */
    protected $sub_type = null;

    /**
     * signed_time_stamp optional bytes = 6
     *
     * @var \Protobuf\Stream
     */
    protected $signed_time_stamp = null;

    /**
     * Check if 'name' has a value
     *
     * @return bool
     */
    public function hasName()
    {
        return $this->name !== null;
    }

    /**
     * Get 'name' value
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set 'name' value
     *
     * @param string $value
     */
    public function setName($value = null)
    {
        $this->name = $value;
    }

    /**
     * Check if 'value' has a value
     *
     * @return bool
     */
    public function hasValue()
    {
        return $this->value !== null;
    }

    /**
     * Get 'value' value
     *
     * @return \Protobuf\Stream
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set 'value' value
     *
     * @param \Protobuf\Stream $value
     */
    public function setValue($value = null)
    {
        if ($value !== null && ! $value instanceof \Protobuf\Stream) {
            $value = \Protobuf\Stream::wrap($value);
        }

        $this->value = $value;
    }

    /**
     * Check if 'content_type' has a value
     *
     * @return bool
     */
    public function hasContentType()
    {
        return $this->content_type !== null;
    }

    /**
     * Get 'content_type' value
     *
     * @return \attrpubapi_v1\ContentType
     */
    public function getContentType()
    {
        return $this->content_type;
    }

    /**
     * Set 'content_type' value
     *
     * @param \attrpubapi_v1\ContentType $value
     */
    public function setContentType(\attrpubapi_v1\ContentType $value = null)
    {
        $this->content_type = $value;
    }

    /**
     * Check if 'artifact_signature' has a value
     *
     * @return bool
     */
    public function hasArtifactSignature()
    {
        return $this->artifact_signature !== null;
    }

    /**
     * Get 'artifact_signature' value
     *
     * @return \Protobuf\Stream
     */
    public function getArtifactSignature()
    {
        return $this->artifact_signature;
    }

    /**
     * Set 'artifact_signature' value
     *
     * @param \Protobuf\Stream $value
     */
    public function setArtifactSignature($value = null)
    {
        if ($value !== null && ! $value instanceof \Protobuf\Stream) {
            $value = \Protobuf\Stream::wrap($value);
        }

        $this->artifact_signature = $value;
    }

    /**
     * Check if 'sub_type' has a value
     *
     * @return bool
     */
    public function hasSubType()
    {
        return $this->sub_type !== null;
    }

    /**
     * Get 'sub_type' value
     *
     * @return string
     */
    public function getSubType()
    {
        return $this->sub_type;
    }

    /**
     * Set 'sub_type' value
     *
     * @param string $value
     */
    public function setSubType($value = null)
    {
        $this->sub_type = $value;
    }

    /**
     * Check if 'signed_time_stamp' has a value
     *
     * @return bool
     */
    public function hasSignedTimeStamp()
    {
        return $this->signed_time_stamp !== null;
    }

    /**
     * Get 'signed_time_stamp' value
     *
     * @return \Protobuf\Stream
     */
    public function getSignedTimeStamp()
    {
        return $this->signed_time_stamp;
    }

    /**
     * Set 'signed_time_stamp' value
     *
     * @param \Protobuf\Stream $value
     */
    public function setSignedTimeStamp($value = null)
    {
        if ($value !== null && ! $value instanceof \Protobuf\Stream) {
            $value = \Protobuf\Stream::wrap($value);
        }

        $this->signed_time_stamp = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function extensions()
    {
        if ( $this->extensions !== null) {
            return $this->extensions;
        }

        return $this->extensions = new \Protobuf\Extension\ExtensionFieldMap(__CLASS__);
    }

    /**
     * {@inheritdoc}
     */
    public function unknownFieldSet()
    {
        return $this->unknownFieldSet;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromStream($stream, \Protobuf\Configuration $configuration = null)
    {
        return new self($stream, $configuration);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $values)
    {
        $message = new self();
        $values  = array_merge([
            'name' => null,
            'value' => null,
            'content_type' => null,
            'artifact_signature' => null,
            'sub_type' => null,
            'signed_time_stamp' => null
        ], $values);

        $message->setName($values['name']);
        $message->setValue($values['value']);
        $message->setContentType($values['content_type']);
        $message->setArtifactSignature($values['artifact_signature']);
        $message->setSubType($values['sub_type']);
        $message->setSignedTimeStamp($values['signed_time_stamp']);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'AttributeSigning',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'name',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'value',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_BYTES(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'content_type',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.attrpubapi_v1.ContentType'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'artifact_signature',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_BYTES(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 5,
                    'name' => 'sub_type',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 6,
                    'name' => 'signed_time_stamp',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_BYTES(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function toStream(\Protobuf\Configuration $configuration = null)
    {
        $config  = $configuration ?: \Protobuf\Configuration::getInstance();
        $context = $config->createWriteContext();
        $stream  = $context->getStream();

        $this->writeTo($context);
        $stream->seek(0);

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function writeTo(\Protobuf\WriteContext $context)
    {
        $stream      = $context->getStream();
        $writer      = $context->getWriter();
        $sizeContext = $context->getComputeSizeContext();

        if ($this->name !== null) {
            $writer->writeVarint($stream, 10);
            $writer->writeString($stream, $this->name);
        }

        if ($this->value !== null) {
            $writer->writeVarint($stream, 18);
            $writer->writeByteStream($stream, $this->value);
        }

        if ($this->content_type !== null) {
            $writer->writeVarint($stream, 24);
            $writer->writeVarint($stream, $this->content_type->value());
        }

        if ($this->artifact_signature !== null) {
            $writer->writeVarint($stream, 34);
            $writer->writeByteStream($stream, $this->artifact_signature);
        }

        if ($this->sub_type !== null) {
            $writer->writeVarint($stream, 42);
            $writer->writeString($stream, $this->sub_type);
        }

        if ($this->signed_time_stamp !== null) {
            $writer->writeVarint($stream, 50);
            $writer->writeByteStream($stream, $this->signed_time_stamp);
        }

        if ($this->extensions !== null) {
            $this->extensions->writeTo($context);
        }

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function readFrom(\Protobuf\ReadContext $context)
    {
        $reader = $context->getReader();
        $length = $context->getLength();
        $stream = $context->getStream();

        $limit = ($length !== null)
            ? ($stream->tell() + $length)
            : null;

        while ($limit === null || $stream->tell() < $limit) {

            if ($stream->eof()) {
                break;
            }

            $key  = $reader->readVarint($stream);
            $wire = \Protobuf\WireFormat::getTagWireType($key);
            $tag  = \Protobuf\WireFormat::getTagFieldNumber($key);

            if ($stream->eof()) {
                break;
            }

            if ($tag === 1) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->name = $reader->readString($stream);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 12);

                $this->value = $reader->readByteStream($stream);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 14);

                $this->content_type = \attrpubapi_v1\ContentType::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 12);

                $this->artifact_signature = $reader->readByteStream($stream);

                continue;
            }

            if ($tag === 5) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->sub_type = $reader->readString($stream);

                continue;
            }

            if ($tag === 6) {
                \Protobuf\WireFormat::assertWireType($wire, 12);

                $this->signed_time_stamp = $reader->readByteStream($stream);

                continue;
            }

            $extensions = $context->getExtensionRegistry();
            $extension  = $extensions ? $extensions->findByNumber(__CLASS__, $tag) : null;

            if ($extension !== null) {
                $this->extensions()->add($extension, $extension->readFrom($context, $wire));

                continue;
            }

            if ($this->unknownFieldSet === null) {
                $this->unknownFieldSet = new \Protobuf\UnknownFieldSet();
            }

            $data    = $reader->readUnknown($stream, $wire);
            $unknown = new \Protobuf\Unknown($tag, $wire, $data);

            $this->unknownFieldSet->add($unknown);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function serializedSize(\Protobuf\ComputeSizeContext $context)
    {
        $calculator = $context->getSizeCalculator();
        $size       = 0;

        if ($this->name !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->name);
        }

        if ($this->value !== null) {
            $size += 1;
            $size += $calculator->computeByteStreamSize($this->value);
        }

        if ($this->content_type !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->content_type->value());
        }

        if ($this->artifact_signature !== null) {
            $size += 1;
            $size += $calculator->computeByteStreamSize($this->artifact_signature);
        }

        if ($this->sub_type !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->sub_type);
        }

        if ($this->signed_time_stamp !== null) {
            $size += 1;
            $size += $calculator->computeByteStreamSize($this->signed_time_stamp);
        }

        if ($this->extensions !== null) {
            $size += $this->extensions->serializedSize($context);
        }

        return $size;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->name = null;
        $this->value = null;
        $this->content_type = null;
        $this->artifact_signature = null;
        $this->sub_type = null;
        $this->signed_time_stamp = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \attrpubapi_v1\AttributeSigning) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->name = ($message->name !== null) ? $message->name : $this->name;
        $this->value = ($message->value !== null) ? $message->value : $this->value;
        $this->content_type = ($message->content_type !== null) ? $message->content_type : $this->content_type;
        $this->artifact_signature = ($message->artifact_signature !== null) ? $message->artifact_signature : $this->artifact_signature;
        $this->sub_type = ($message->sub_type !== null) ? $message->sub_type : $this->sub_type;
        $this->signed_time_stamp = ($message->signed_time_stamp !== null) ? $message->signed_time_stamp : $this->signed_time_stamp;
    }


}

