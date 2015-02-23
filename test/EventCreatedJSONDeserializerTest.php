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

    public function testRequiresEventId()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'eventId is missing'
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
                    "eventId": "foo"
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
                    "eventId": "foo",
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
                    "eventId": "foo",
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
                    "eventId": "foo",
                    "time": "2015-02-20T20:39:09+0100",
                    "author": "me@example.com"
                }'
            )
        );

        $this->assertInstanceOf(
            EventCreated::class,
            $eventCreated
        );

        $this->assertEquals(
            new String('foo'),
            $eventCreated->getEventId()
        );

        $this->assertEquals(
            new String('me@example.com'),
            $eventCreated->getAuthor()
        );

        $this->assertEquals(
            DateTime::createFromFormat(
                DateTime::ISO8601,
                '2015-02-20T20:39:09+0100'
            ),
            $eventCreated->getTime()
        );
    }
}