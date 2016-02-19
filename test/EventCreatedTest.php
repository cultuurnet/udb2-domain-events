<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class EventCreatedTest extends \PHPUnit_Framework_TestCase
{
    public function testUrlCanNotBeEmptyString()
    {
        $this->setExpectedException(
            \InvalidArgumentException::class,
            'url can not be empty'
        );

        new EventCreated(
            new \DateTimeImmutable(),
            new String(''),
            new String('')
        );
    }

    private function createEventCreated(\DateTimeImmutable $time = null)
    {
        if (null === $time) {
            $time = new \DateTimeImmutable();
        }

        return new EventCreated(
            $time,
            new String('me@example.com'),
            new String('http://foo.bar/event/foo')
        );
    }

    public function testGetAuthor()
    {
        $eventCreated = $this->createEventCreated();

        $this->assertEquals(
            new String('me@example.com'),
            $eventCreated->getAuthor()
        );
    }

    public function testTime()
    {
        $time = new \DateTimeImmutable();
        $expectedTime = clone $time;

        $eventCreated = $this->createEventCreated($time);

        // Adjustments to the time after creating the event should
        // not affect the event time.
        $time->modify('+5 days');

        $this->assertEquals(
            $expectedTime,
            $eventCreated->getTime()
        );
    }

    public function testGetUrl()
    {
        $eventCreated = $this->createEventCreated();

        $this->assertEquals(
            new String('http://foo.bar/event/foo'),
            $eventCreated->getUrl()
        );
    }
}
