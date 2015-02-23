<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class EventCreated
{
    use HasEventIdTrait;
    use HasAuthoringMetadataTrait;

    /**
     * @var String
     */
    protected $eventId;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var String
     */
    protected $author;

    /**
     * @param String $eventId
     * @param \DateTime $time
     */
    public function __construct(String $eventId, \DateTime $time, String $author)
    {
        $this->setEventId($eventId);
        $this->setTime($time);
        $this->setAuthor($author);
    }
}