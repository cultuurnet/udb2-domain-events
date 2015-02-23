<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

trait HasEventIdTrait
{
    private function setEventId(String $eventId)
    {
        if ($eventId->isEmpty()) {
            throw new \InvalidArgumentException('event id can not be empty');
        }
        $this->eventId = $eventId;
    }

    /**
     * @return String
     */
    public function getEventId()
    {
        return $this->eventId;
    }
}
