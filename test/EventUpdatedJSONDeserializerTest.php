<?php

namespace CultuurNet\UDB2DomainEvents;

use CultuurNet\Deserializer\MissingValueException;
use DateTime;
use PHPUnit\Framework\TestCase;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Web\Url;

class EventUpdatedJSONDeserializerTest extends TestCase
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
        $this->expectException(MissingValueException::class);
        $this->expectExceptionMessage('eventId is missing');

        $this->deserializer->deserialize(
            new StringLiteral('{}')
        );
    }

    public function testRequiresTime()
    {
        $this->expectException(MissingValueException::class);
        $this->expectExceptionMessage('time is missing');

        $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "eventId": "foo",
                    "url": "http://foo.bar/event/foo"
                }'
            )
        );
    }

    public function testTimeNeedsToBeISO8601Formatted()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('invalid time provided');

        $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "eventId": "foo",
                    "author": "me@example.com",
                    "time": "2014-12-12",
                    "url": "http://foo.bar/event/foo"
                }'
            )
        );
    }

    public function testRequiresAuthor()
    {
        $this->expectException(MissingValueException::class);
        $this->expectExceptionMessage('author is missing');

        $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "eventId": "foo",
                    "time": "2015-02-20T20:39:09+0100",
                    "url": "http://foo.bar/event/foo"
                }'
            )
        );
    }

    public function testRequiresUrl()
    {
        $this->expectException(MissingValueException::class);
        $this->expectExceptionMessage('url is missing');

        $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "eventId": "foo",
                    "author": "me@example.com",
                    "time": "2015-02-20T20:39:09+0100"
                }'
            )
        );
    }

    public function testReturnsEventUpdated()
    {
        /** @var EventUpdated $eventUpdated */
        $eventUpdated = $this->deserializer->deserialize(
            new StringLiteral(
                '{
                    "eventId": "foo",
                    "time": "2015-02-20T20:39:09+0100",
                    "author": "me@example.com",
                    "url": "http://foo.bar/event/foo"
                }'
            )
        );

        $this->assertInstanceOf(
            EventUpdated::class,
            $eventUpdated
        );

        $this->assertEquals(
            new StringLiteral('foo'),
            $eventUpdated->getEventId()
        );

        $this->assertEquals(
            new StringLiteral('me@example.com'),
            $eventUpdated->getAuthor()
        );

        $this->assertEquals(
            Url::fromNative('http://foo.bar/event/foo'),
            $eventUpdated->getUrl()
        );

        $this->assertEquals(
            \DateTimeImmutable::createFromFormat(
                DateTime::ISO8601,
                '2015-02-20T20:39:09+0100'
            ),
            $eventUpdated->getTime()
        );
    }
}
