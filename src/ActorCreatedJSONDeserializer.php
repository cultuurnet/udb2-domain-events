<?php

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\JSONDeserializer;
use CultuurNet\Deserializer\MissingValueException;
use ValueObjects\String\String as StringLiteral;

class ActorCreatedJSONDeserializer extends JSONDeserializer
{
    /**
     * @param StringLiteral $json
     * @return ActorCreated
     */
    public function deserialize(StringLiteral $json)
    {
        $json = parent::deserialize($json);

        if (!isset($json->actorId)) {
            throw new MissingValueException('actorId is missing');
        }

        if (!isset($json->time)) {
            throw new MissingValueException('time is missing');
        }

        if (!isset($json->author)) {
            throw new MissingValueException('author is missing');
        }

        if (!isset($json->url)) {
            throw new MissingValueException('url is missing');
        }

        return ActorCreated::deserialize((array) $json);
    }
}
