<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

abstract class JSONDeserializer implements JSONDeserializerInterface
{
    /**
     * Decodes a JSON string into a generic PHP object.
     *
     * @param String $json
     * @return \stdClass
     */
    public function fromJSON(String $json)
    {
        $json = json_decode($json->toNative());

        if (null === $json) {
            throw new NotWellFormedException('Invalid JSON');
        }

        return $json;
    }
}
