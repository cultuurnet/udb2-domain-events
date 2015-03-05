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
     * @param String $actorId
     * @param \DateTime $time
     * @param String $author
     */
    public function __construct(String $actorId, \DateTime $time, String $author)
    {
        $this->setActorId($actorId);
        $this->setTime($time);
        $this->setAuthor($author);
    }
}
