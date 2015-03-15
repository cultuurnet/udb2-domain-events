<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\MissingValueException;
use DateTime;
use ValueObjects\String\String;

class ActorCreatedJSONDeserializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ActorCreatedJSONDeserializer
     */
    protected $deserializer;

    public function setUp()
    {
        $this->deserializer = new ActorCreatedJSONDeserializer();
    }

    public function testRequiresActorId()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'actorId is missing'
        );

        $this->deserializer->deserialize(
            new String('{}')
        );
    }

    public function testRequiresTime()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'time is missing'
        );

        $this->deserializer->deserialize(
            new String(
                '{
                    "actorId": "foo"
                }'
            )
        );
    }

    public function testTimeNeedsToBeISO8601Formatted()
    {
        $this->setExpectedException(
            \RuntimeException::class,
            'invalid time provided'
        );

        $this->deserializer->deserialize(
            new String(
                '{
                    "actorId": "foo",
                    "author": "me@example.com",
                    "time": "2014-12-12"
                }'
            )
        );
    }

    public function testRequiresAuthor()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'author is missing'
        );

        $this->deserializer->deserialize(
            new String(
                '{
                    "actorId": "foo",
                    "time": "2015-02-20T20:39:09+0100"
                }'
            )
        );
    }

    public function testReturnsActorCreated()
    {
        $actorCreated = $this->deserializer->deserialize(
            new String(
                '{
                    "actorId": "foo",
                    "time": "2015-02-20T20:39:09+0100",
                    "author": "me@example.com"
                }'
            )
        );

        $this->assertInstanceOf(
            ActorCreated::class,
            $actorCreated
        );

        $this->assertEquals(
            new String('foo'),
            $actorCreated->getActorId()
        );

        $this->assertEquals(
            new String('me@example.com'),
            $actorCreated->getAuthor()
        );

        $this->assertEquals(
            \DateTimeImmutable::createFromFormat(
                DateTime::ISO8601,
                '2015-02-20T20:39:09+0100'
            ),
            $actorCreated->getTime()
        );
    }
}
