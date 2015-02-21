<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

interface DeserializerInterface
{
    public function deserialize(String $data);
}
