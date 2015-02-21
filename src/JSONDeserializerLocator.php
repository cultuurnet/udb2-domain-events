<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class JSONDeserializerLocator implements JSONDeserializerLocatorInterface
{
    /**
     * @var JSONDeserializerInterface[]
     */
    protected $deserializers = [];

    public function registerDeserializer(
        String $contentType,
        JSONDeserializerInterface $deserializer
    ) {
        $this->deserializers[$contentType->toNative()] = $deserializer;
    }

    public function getDeserializerForContentType(String $contentType)
    {
        if (array_key_exists($contentType->toNative(), $this->deserializers)) {
            return $this->deserializers[$contentType->toNative()];
        }

        throw new JSONDeserializerNotFoundException(
            'Unable to find a deserializer for content type ' . $contentType
        );
    }
}
