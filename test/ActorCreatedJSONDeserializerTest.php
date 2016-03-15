<?php

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\MissingValueException;
use DateTime;
use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

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
            new StringLiteral('{}')
        );
    }

    public function testRequiresTime()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'time is missing'
        );

        $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "actorId": "foo",
                    "url": "http://foo.bar/event/foo"
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
            new StringLiteral(
                '{
                    "actorId": "foo",
                    "author": "me@example.com",
                    "time": "2014-12-12",
                    "url": "http://foo.bar/event/foo"
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
            new StringLiteral(
                '{
                    "actorId": "foo",
                    "time": "2015-02-20T20:39:09+0100",
                    "url": "http://foo.bar/event/foo"
                }'
            )
        );
    }

    public function testRequiresUrl()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'url is missing'
        );

        $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "actorId": "foo",
                    "author": "me@example.com",
                    "time": "2015-02-20T20:39:09+0100"
                }'
            )
        );
    }

    public function testReturnsActorCreated()
    {
        $actorCreated = $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "actorId": "foo",
                    "time": "2015-02-20T20:39:09+0100",
                    "author": "me@example.com",
                    "url": "http://foo.bar/event/foo"
                }'
            )
        );

        $this->assertInstanceOf(
            ActorCreated::class,
            $actorCreated
        );

        $this->assertEquals(
            new StringLiteral('foo'),
            $actorCreated->getActorId()
        );

        $this->assertEquals(
            new StringLiteral('me@example.com'),
            $actorCreated->getAuthor()
        );

        $this->assertEquals(
            \DateTimeImmutable::createFromFormat(
                DateTime::ISO8601,
                '2015-02-20T20:39:09+0100'
            ),
            $actorCreated->getTime()
        );

        $this->assertEquals(
            Url::fromNative('http://foo.bar/event/foo'),
            $actorCreated->getUrl()
        );
    }
}
