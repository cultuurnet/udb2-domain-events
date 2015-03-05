<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class ActorUpdatedTest extends \PHPUnit_Framework_TestCase
{
    public function testActorIdCanNotBeEmptyString()
    {
        $this->setExpectedException(
            \InvalidArgumentException::class,
            'actor id can not be empty'
        );

        new ActorUpdated(
            new String(''),
            new \DateTime(),
            new String('')
        );
    }

    private function createActorUpdated(\DateTime $time = null)
    {
        if (null === $time) {
            $time = new \DateTime();
        }

        return new ActorUpdated(
            new String('123'),
            $time,
            new String('me@example.com')
        );
    }

    public function testGetActorId()
    {
        $actorUpdated = $this->createActorUpdated();

        $this->assertEquals(
            new String('123'),
            $actorUpdated->getActorId()
        );
    }

    public function testGetAuthor()
    {
        $actorUpdated = $this->createActorUpdated();

        $this->assertEquals(
            new String('me@example.com'),
            $actorUpdated->getAuthor()
        );
    }

    public function testTime()
    {
        $time = new \DateTime();
        $expectedTime = clone $time;

        $actorUpdated = $this->createActorUpdated($time);

        // Adjustments to the time after creating the event should
        // not affect the event time.
        $time->modify('+5 days');

        $this->assertEquals(
            $expectedTime,
            $actorUpdated->getTime()
        );
    }
}
