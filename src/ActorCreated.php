<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class ActorCreated
{
    use HasActorIdTrait;
    use HasAuthoringMetadataTrait;

    /**
     * @param String|String $actorId
     * @param \DateTimeImmutable $time
     * @param String|String $author
     */
    public function __construct(String $actorId, \DateTimeImmutable $time, String $author)
    {
        $this->setActorId($actorId);
        $this->setTime($time);
        $this->setAuthor($author);
    }
}
