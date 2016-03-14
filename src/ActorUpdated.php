<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

class ActorUpdated
{
    use HasActorIdTrait;
    use HasAuthoringMetadataTrait;
    use HasUrlTrait;

    /**
     * @param StringLiteral $actorId
     * @param \DateTimeImmutable $time
     * @param StringLiteral $author
     * @param Url $url
     */
    public function __construct(
        StringLiteral $actorId,
        \DateTimeImmutable $time,
        StringLiteral $author,
        Url $url
    ) {
        $this->setActorId($actorId);
        $this->setTime($time);
        $this->setAuthor($author);
        $this->setUrl($url);
    }
}
