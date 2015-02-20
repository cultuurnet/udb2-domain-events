<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use \DateTime;
use ValueObjects\String\String;

class EventUpdatedJSONDeserializer extends JSONDeserializer
{
    public function fromJSON(String $json)
    {
        $json = parent::fromJSON($json);

        if (!isset($json->eventId)) {
            throw new MissingValueException('eventId is missing');
        }

        if (!isset($json->time)) {
            throw new MissingValueException('time is missing');
        }

        if (!isset($json->author)) {
            throw new MissingValueException('author is missing');
        }

        $time = \DateTime::createFromFormat(
            DateTime::ISO8601,
            $json->time
        );

        if (!$time instanceof DateTime) {
            // @todo Replace with a more specific exception.
            $now = new DateTime();
            throw new \RuntimeException(
                'invalid time provided, please use a ISO 8601 formatted date' .
                '& time like ' . $now->format(DateTime::ISO8601)
            );
        }

        return new EventUpdated(
            new String($json->eventId),
            $time,
            new String($json->author)
        );
    }
}
