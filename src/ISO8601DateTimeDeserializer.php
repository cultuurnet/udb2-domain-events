<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use \DateTime;
use ValueObjects\String\String;

class ISO8601DateTimeDeserializer
{
    /**
     * @param String $timeString
     *
     * @return DateTime
     */
    public static function deserialize(String $timeString)
    {
        $time = DateTime::createFromFormat(
            DateTime::ISO8601,
            $timeString
        );

        if (!$time instanceof DateTime) {
            // @todo Replace with a more specific exception.
            $now = new DateTime();
            throw new \RuntimeException(
                'invalid time provided, please use a ISO 8601 formatted date' .
                '& time like ' . $now->format(DateTime::ISO8601)
            );
        }

        return $time;
    }
}
