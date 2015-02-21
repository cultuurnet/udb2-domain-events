<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class SimpleDeserializerLocator implements DeserializerLocatorInterface
{
    /**
     * @var DeserializerInterface[]
     */
    protected $deserializers = [];

    /**
     * @param String $contentType
     * @param DeserializerInterface $deserializer
     */
    public function registerDeserializer(
        String $contentType,
        DeserializerInterface $deserializer
    ) {
        $this->deserializers[$contentType->toNative()] = $deserializer;
    }

    /**
     * @param String $contentType
     * @return DeserializerInterface
     */
    public function getDeserializerForContentType(String $contentType)
    {
        if (array_key_exists($contentType->toNative(), $this->deserializers)) {
            return $this->deserializers[$contentType->toNative()];
        }

        throw new DeserializerNotFoundException(
            "Unable to find a deserializer for content type '{$contentType->toNative()}'"
        );
    }
}
