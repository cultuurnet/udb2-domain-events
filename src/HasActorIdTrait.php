<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String as StringLiteral;

trait HasActorIdTrait
{

    /**
     * @var String
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
     * @return String
     */
    public function getActorId()
    {
        return $this->actorId;
    }
}
