<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class ActorUpdated
{
    use HasAuthoringMetadataTrait;
    use HasUrlTrait;

    /**
     * @param \DateTimeImmutable $time
     * @param String $author
     * @param String $url
     */
    public function __construct(\DateTimeImmutable $time, String $author, String $url)
    {
        $this->setTime($time);
        $this->setAuthor($author);
        $this->setUrl($url);
    }
}
