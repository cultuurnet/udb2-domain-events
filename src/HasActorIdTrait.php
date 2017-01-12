<?php

namespace CultuurNet\UDB2DomainEvents;

use DateTime;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Web\Url;

trait HasActorIdTrait
{

    /**
     * @var StringLiteral
     */
    private $actorId;

    /**
     * @param StringLiteral $actorId
     */
    private function setActorId(StringLiteral $actorId)
    {
        if ($actorId->isEmpty()) {
            throw new \InvalidArgumentException('actor id can not be empty');
        }
        $this->actorId = $actorId;
    }

    /**
     * @return StringLiteral
     */
    public function getActorId()
    {
        return $this->actorId;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'actorId' => (string) $this->getActorId(),
        ];
    }
}
