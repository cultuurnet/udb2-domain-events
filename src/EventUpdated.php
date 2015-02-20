<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class EventUpdated
{
    /**
     * @var String
     */
    protected $eventId;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @param String $eventId
     * @param \DateTime $time
     */
    public function __construct(String $eventId, \DateTime $time)
    {
        $this->eventId = $eventId;
        $this->time = $time;
    }
}
