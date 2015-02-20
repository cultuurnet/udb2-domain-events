<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

interface JSONDeserializerInterface
{
    public function fromJSON(String $json);
}
