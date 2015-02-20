<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class EventUpdatedTest extends \PHPUnit_Framework_TestCase
{
    public function testEventIdCanNotBeEmptyString()
    {
        $this->setExpectedException(
            \InvalidArgumentException::class,
            'event id can not be empty'
        );

        new EventUpdated(
            new String(''),
            new \DateTime(),
            new String('')
        );
    }
}
