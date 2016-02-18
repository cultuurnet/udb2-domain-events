<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

trait HasUrlTrait
{
    /**
     * @var String
     */
    protected $url;

    private function setUrl(String $url)
    {
        if ($url->isEmpty()) {
            throw new \InvalidArgumentException('url can not be empty');
        }
        $this->url = $url;
    }

    /**
     * @return String
     */
    public function getUrl()
    {
        return $this->url;
    }
}
