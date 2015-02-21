<?php
/**
 * @file
 */
namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

interface DeserializerLocatorInterface
{
    public function getDeserializerForContentType(String $contentType);
}
