<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class ActorUpdated
{
    use HasActorIdTrait;
    use HasAuthoringMetadataTrait;
    use HasUrlTrait;

    /**
     * @param String $actorId
     * @param \DateTimeImmutable $time
     * @param String $author
     * @param String $url
     */
    public function __construct(String $actorId, \DateTimeImmutable $time, String $author, String $url)
    {
        $this->setActorId($actorId);
        $this->setTime($time);
        $this->setAuthor($author);
        $this->setUrl($url);
    }
}
