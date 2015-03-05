<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\JSONDeserializer;
use CultuurNet\Deserializer\MissingValueException;
use ValueObjects\String\String;

class ActorUpdatedJSONDeserializer extends JSONDeserializer
{
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

        $time = ISO8601DateTimeDeserializer::deserialize(
            new String($json->time)
        );

        return new ActorUpdated(
            new String($json->actorId),
            $time,
            new String($json->author)
        );
    }
}
