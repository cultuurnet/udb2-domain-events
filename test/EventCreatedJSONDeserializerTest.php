<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\MissingValueException;
use DateTime;
use ValueObjects\String\String;

class EventCreatedJSONDeserializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventCreatedJSONDeserializer
     */
    protected $deserializer;

    public function setUp()
    {
        $this->deserializer = new EventCreatedJSONDeserializer();
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
                    "author": "me@example.com",
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
            new String(
                '{
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
            new String(
                '{
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
            new String(
                '{
                    "author": "me@example.com",
                    "time": "2015-02-20T20:39:09+0100"
                }'
            )
        );
    }

    public function testReturnsEventCreated()
    {
        $eventCreated = $this->deserializer->deserialize(
            new String(
                '{
                    "time": "2015-02-20T20:39:09+0100",
                    "author": "me@example.com",
                    "url": "http://foo.bar/event/foo"
                }'
            )
        );

        $this->assertInstanceOf(
            EventCreated::class,
            $eventCreated
        );

        $this->assertEquals(
            new String('me@example.com'),
            $eventCreated->getAuthor()
        );

        $this->assertEquals(
            new String('http://foo.bar/event/foo'),
            $eventCreated->getUrl()
        );

        $this->assertEquals(
            \DateTimeImmutable::createFromFormat(
                DateTime::ISO8601,
                '2015-02-20T20:39:09+0100'
            ),
            $eventCreated->getTime()
        );
    }
}
