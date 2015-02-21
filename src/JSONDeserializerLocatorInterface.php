<?php
/**
 * @file
 */
namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

interface JSONDeserializerLocatorInterface
{
    public function getDeserializerForContentType(String $contentType);
}
