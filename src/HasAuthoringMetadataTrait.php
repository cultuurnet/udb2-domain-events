<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

trait HasAuthoringMetadataTrait
{
    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var String
     */
    protected $author;

    private function setTime(\DateTime $time)
    {
        $this->time = clone $time;
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
