<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class EventUpdated
{
    use HasEventIdTrait;
    use HasAuthoringMetadataTrait;
    use HasUrlTrait;

    /**
     * @param String $eventId
     * @param \DateTimeImmutable $time
     * @param String $author
     * @param String $url
     */
    public function __construct(String $eventId, \DateTimeImmutable $time, String $author, String $url)
    {
        $this->setEventId($eventId);
        $this->setTime($time);
        $this->setAuthor($author);
        $this->setUrl($url);
    }
}
