<?php

namespace CultuurNet\UDB2DomainEvents;

use Broadway\Serializer\SerializableInterface;
use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

class EventCreated implements SerializableInterface
{
    use HasEventIdTrait;
    use HasAuthoringMetadataTrait;
    use HasUrlTrait;

    /**
     * @param StringLiteral $eventId
     * @param \DateTimeImmutable $time
     * @param StringLiteral $author
     * @param Url $url
     */
    public function __construct(
        StringLiteral $eventId,
        \DateTimeImmutable $time,
        StringLiteral $author,
        Url $url
    ) {
        $this->setEventId($eventId);
        $this->setTime($time);
        $this->setAuthor($author);
        $this->setUrl($url);
    }
}
