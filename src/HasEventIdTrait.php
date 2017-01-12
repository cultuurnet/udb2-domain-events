<?php

namespace CultuurNet\UDB2DomainEvents;

use DateTime;
use ValueObjects\StringLiteral\StringLiteral;
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

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'eventId' => (string) $this->getEventId(),
        ];
    }
}
