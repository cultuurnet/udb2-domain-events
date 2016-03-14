<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String as StringLiteral;

trait HasAuthoringMetadataTrait
{
    /**
     * @var \DateTimeImmutable
     */
    protected $time;

    /**
     * @var String
     */
    protected $author;

    private function setTime(\DateTimeImmutable $time)
    {
        $this->time = $time;
    }

    private function setAuthor(StringLiteral $author)
    {
        $this->author = $author;
    }

    /**
     * @return StringLiteral
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
}
