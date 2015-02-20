<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use DateTime;
use ValueObjects\String\String;

class EventUpdatedJSONDeserializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventUpdatedJSONDeserializer
     */
    protected $deserializer;

    public function setUp()
    {
        $this->deserializer = new EventUpdatedJSONDeserializer();
    }

    public function testRequiresEventId()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'event_id is missing'
        );

        $this->deserializer->fromJSON(
            new String('{}')
        );
    }

    public function testRequiresTime()
    {
        $this->setExpectedException(
            MissingValueException::class,
            'time is missing'
        );

        $this->deserializer->fromJSON(
            new String(
                '{
                    "event_id": "foo"
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

        $this->deserializer->fromJSON(
            new String(
                '{
                    "event_id": "foo",
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

        $this->deserializer->fromJSON(
            new String(
                '{
                    "event_id": "foo",
                    "time": "2015-02-20T20:39:09+0100"
                }'
            )
        );
    }

    public function testReturnsEventUpdated()
    {
        $eventUpdated = $this->deserializer->fromJSON(
            new String(
                '{
                    "event_id": "foo",
                    "time": "2015-02-20T20:39:09+0100",
                    "author": "me@example.com"
                }'
            )
        );

        $this->assertInstanceOf(
            EventUpdated::class,
            $eventUpdated
        );

        $this->assertEquals(
            new String('foo'),
            $eventUpdated->getEventId()
        );

        $this->assertEquals(
            new String('me@example.com'),
            $eventUpdated->getAuthor()
        );

        $this->assertEquals(
            DateTime::createFromFormat(
                DateTime::ISO8601,
                '2015-02-20T20:39:09+0100'
            ),
            $eventUpdated->getTime()
        );
    }
}
