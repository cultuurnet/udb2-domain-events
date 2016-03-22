<?php

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\Web\Url;

trait HasUrlTrait
{
    /**
     * @var Url
     */
    protected $url;

    private function setUrl(Url $url)
    {
        $this->url = $url;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }
}
