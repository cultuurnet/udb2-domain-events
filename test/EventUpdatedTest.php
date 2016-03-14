<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;
use ValueObjects\Web\Url;

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
            new \DateTimeImmutable(),
            new String(''),
            Url::fromNative('http://foo.bar/event/foo')
        );
    }

    private function createEventUpdated(\DateTimeImmutable $time = null)
    {
        if (null === $time) {
            $time = new \DateTimeImmutable();
        }

        return new EventUpdated(
            new String('123'),
            $time,
            new String('me@example.com'),
            Url::fromNative('http://foo.bar/event/foo')
        );
    }

    public function testGetEventId()
    {
        $eventUpdated = $this->createEventUpdated();

        $this->assertEquals(
            new String('123'),
            $eventUpdated->getEventId()
        );
    }

    public function testGetAuthor()
    {
        $eventUpdated = $this->createEventUpdated();

        $this->assertEquals(
            new String('me@example.com'),
            $eventUpdated->getAuthor()
        );
    }

    public function testTime()
    {
        $time = new \DateTimeImmutable();
        $expectedTime = clone $time;

        $eventUpdated = $this->createEventUpdated($time);

        // Adjustments to the time after creating the event should
        // not affect the event time.
        $time->modify('+5 days');

        $this->assertEquals(
            $expectedTime,
            $eventUpdated->getTime()
        );
    }

    public function testGetUrl()
    {
        $eventUpdated = $this->createEventUpdated();

        $this->assertEquals(
            Url::fromNative('http://foo.bar/event/foo'),
            $eventUpdated->getUrl()
        );
    }
}
