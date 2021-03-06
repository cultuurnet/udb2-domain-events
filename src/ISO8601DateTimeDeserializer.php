<?php

namespace CultuurNet\UDB2DomainEvents;

use DateTime;
use DateTimeImmutable;
use ValueObjects\StringLiteral\StringLiteral;

class ISO8601DateTimeDeserializer
{
    /**
     * @param StringLiteral $timeString
     *
     * @return \DateTimeImmutable
     */
    public static function deserialize(StringLiteral $timeString)
    {
        $time = DateTimeImmutable::createFromFormat(
            DateTime::ISO8601,
            $timeString
        );

        if (!$time instanceof DateTimeImmutable) {
            // @todo Replace with a more specific exception.
            $now = new DateTimeImmutable();
            throw new \RuntimeException(
                'invalid time provided, please use a ISO 8601 formatted date' .
                '& time like ' . $now->format(DateTime::ISO8601)
            );
        }

        return $time;
    }
}
