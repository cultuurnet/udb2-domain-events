<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class ActorCreatedTest extends \PHPUnit_Framework_TestCase
{
    public function testUrlCanNotBeEmptyString()
    {
        $this->setExpectedException(
            \InvalidArgumentException::class,
            'url can not be empty'
        );

        new ActorCreated(
            new String('foo'),
            new \DateTimeImmutable(),
            new String(''),
            new String('')
        );
    }

    public function testActorIdCanNotBeEmptyString()
    {
        $this->setExpectedException(
            \InvalidArgumentException::class,
            'actor id can not be empty'
        );

        new ActorCreated(
            new String(''),
            new \DateTimeImmutable(),
            new String(''),
            new String('')
        );
    }

    private function createActorCreated(\DateTimeImmutable $time = null)
    {
        if (null === $time) {
            $time = new \DateTimeImmutable();
        }

        return new ActorCreated(
            new String('123'),
            $time,
            new String('me@example.com'),
            new String('http://foo.bar/event/foo')
        );
    }

    public function testGetActorId()
    {
        $eventCreated = $this->createActorCreated();

        $this->assertEquals(
            new String('123'),
            $eventCreated->getActorId()
        );
    }

    public function testGetAuthor()
    {
        $eventCreated = $this->createActorCreated();

        $this->assertEquals(
            new String('me@example.com'),
            $eventCreated->getAuthor()
        );
    }

    public function testTime()
    {
        $time = new \DateTimeImmutable();
        $expectedTime = clone $time;

        $eventCreated = $this->createActorCreated($time);

        // Adjustments to the time after creating the event should
        // not affect the event time.
        $time->modify('+5 days');

        $this->assertEquals(
            $expectedTime,
            $eventCreated->getTime()
        );
    }

    public function testUrl()
    {
        $eventCreated = $this->createActorCreated();

        $this->assertEquals(
            new String('http://foo.bar/event/foo'),
            $eventCreated->getUrl()
        );
    }
}
