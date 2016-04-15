<?php

namespace CultuurNet\UDB2DomainEvents;

use DateTime;
use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

trait HasEventIdTrait
{
    /**
     * @var StringLiteral
     */
    protected $eventId;
    
    private function setEventId(StringLiteral $eventId)
    {
        if ($eventId->isEmpty()) {
            throw new \InvalidArgumentException('event id can not be empty');
        }
        $this->eventId = $eventId;
    }

    /**
     * @return StringLiteral
     */
    public function getEventId()
    {
        return $this->eventId;
    }


    public function serialize()
    {
        return [
            'eventId' => (string) $this->getEventId(),
            'time' => $this->getTime()->format(DateTime::ISO8601),
            'author' => (string) $this->getAuthor(),
            'url' => (string) $this->getUrl(),
        ];
    }

    public static function deserialize(array $data)
    {
        return new static(
            new StringLiteral($data['eventId']),
            ISO8601DateTimeDeserializer::deserialize(
                new StringLiteral($data['time'])
            ),
            new StringLiteral($data['author']),
            Url::fromNative($data['url'])
        );
    }
}
