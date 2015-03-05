<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

trait HasActorIdTrait
{

    /**
     * @var String
     */
    private $actorId;

    /**
     * @param String $actorId
     */
    private function setActorId(String $actorId)
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
