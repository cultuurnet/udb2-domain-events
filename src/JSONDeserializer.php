<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

abstract class JSONDeserializer implements DeserializerInterface
{
    /**
     * Decodes a JSON string into a generic PHP object.
     *
     * @param String $data
     * @return \stdClass
     */
    public function deserialize(String $data)
    {
        $data = json_decode($data->toNative());

        if (null === $data) {
            throw new NotWellFormedException('Invalid JSON');
        }

        return $data;
    }
}
