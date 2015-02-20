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

    private function setEventId(String $eventId)
    {
        if ($eventId->isEmpty()) {
            throw new \InvalidArgumentException('event id can not be empty');
        }
        $this->eventId = $eventId;
    }

    private function setTime(\DateTime $time)
    {
        $this->time = $time;
    }

    private function setAuthor(String $author)
    {
        $this->author = $author;
    }

    /**
     * @return String
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return String
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
}
