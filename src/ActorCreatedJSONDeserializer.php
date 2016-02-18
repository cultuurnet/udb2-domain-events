<?php

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\JSONDeserializer;
use CultuurNet\Deserializer\MissingValueException;
use ValueObjects\String\String;

class ActorCreatedJSONDeserializer extends JSONDeserializer
{
    /**
     * @param String $json
     * @return ActorCreated
     */
    public function deserialize(String $json)
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

        $time = ISO8601DateTimeDeserializer::deserialize(
            new String($json->time)
        );

        return new ActorCreated(
            new String($json->actorId),
            $time,
            new String($json->author),
            new String($json->url)
        );
    }
}
