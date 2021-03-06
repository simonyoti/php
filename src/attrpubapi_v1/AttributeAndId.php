<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : List.proto
 */


namespace attrpubapi_v1;

/**
 * Protobuf message : attrpubapi_v1.AttributeAndId
 */
class AttributeAndId extends \Protobuf\AbstractMessage
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
     * attribute optional message = 1
     *
     * @var \attrpubapi_v1\Attribute
     */
    protected $attribute = null;

    /**
     * attribute_id optional bytes = 2
     *
     * @var \Protobuf\Stream
     */
    protected $attribute_id = null;

    /**
     * Check if 'attribute' has a value
     *
     * @return bool
     */
    public function hasAttribute()
    {
        return $this->attribute !== null;
    }

    /**
     * Get 'attribute' value
     *
     * @return \attrpubapi_v1\Attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set 'attribute' value
     *
     * @param \attrpubapi_v1\Attribute $value
     */
    public function setAttribute(\attrpubapi_v1\Attribute $value = null)
    {
        $this->attribute = $value;
    }

    /**
     * Check if 'attribute_id' has a value
     *
     * @return bool
     */
    public function hasAttributeId()
    {
        return $this->attribute_id !== null;
    }

    /**
     * Get 'attribute_id' value
     *
     * @return \Protobuf\Stream
     */
    public function getAttributeId()
    {
        return $this->attribute_id;
    }

    /**
     * Set 'attribute_id' value
     *
     * @param \Protobuf\Stream $value
     */
    public function setAttributeId($value = null)
    {
        if ($value !== null && ! $value instanceof \Protobuf\Stream) {
            $value = \Protobuf\Stream::wrap($value);
        }

        $this->attribute_id = $value;
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
            'attribute' => null,
            'attribute_id' => null
        ], $values);

        $message->setAttribute($values['attribute']);
        $message->setAttributeId($values['attribute_id']);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'AttributeAndId',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'attribute',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.attrpubapi_v1.Attribute'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'attribute_id',
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

        if ($this->attribute !== null) {
            $writer->writeVarint($stream, 10);
            $writer->writeVarint($stream, $this->attribute->serializedSize($sizeContext));
            $this->attribute->writeTo($context);
        }

        if ($this->attribute_id !== null) {
            $writer->writeVarint($stream, 18);
            $writer->writeByteStream($stream, $this->attribute_id);
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
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \attrpubapi_v1\Attribute();

                $this->attribute = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 12);

                $this->attribute_id = $reader->readByteStream($stream);

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

        if ($this->attribute !== null) {
            $innerSize = $this->attribute->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->attribute_id !== null) {
            $size += 1;
            $size += $calculator->computeByteStreamSize($this->attribute_id);
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
        $this->attribute = null;
        $this->attribute_id = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \attrpubapi_v1\AttributeAndId) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->attribute = ($message->attribute !== null) ? $message->attribute : $this->attribute;
        $this->attribute_id = ($message->attribute_id !== null) ? $message->attribute_id : $this->attribute_id;
    }


}

