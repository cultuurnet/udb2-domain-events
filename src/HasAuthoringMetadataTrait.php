<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

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

    private function setAuthor(String $author)
    {
        $this->author = $author;
    }

    /**
     * @return String
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
