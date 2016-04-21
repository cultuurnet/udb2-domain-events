<?php

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\JSONDeserializer;
use CultuurNet\Deserializer\MissingValueException;
use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

class EventUpdatedJSONDeserializer extends JSONDeserializer
{
    public function deserialize(StringLiteral $json)
    {
        $json = parent::deserialize($json);

        if (!isset($json->eventId)) {
            throw new MissingValueException('eventId is missing');
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

        return EventUpdated::deserialize((array) $json);
    }
}
