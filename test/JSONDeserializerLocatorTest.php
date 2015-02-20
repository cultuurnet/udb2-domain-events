<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class JSONDeserializerLocatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JSONDeserializerLocator
     */
    protected $deserializerLocator;

    public function setUp()
    {
        $this->deserializerLocator = new JSONDeserializerLocator();
    }

    public function testGivesBackDeserializerThatWasRegistered()
    {
        $firstDeserializer = $this->getMock(JSONDeserializerInterface::class);
        $anotherDeserializer = $this->getMock(JSONDeserializerInterface::class);

        $this->deserializerLocator->registerDeserializer(
            new String('application/vnd.cultuurnet.foo'),
            $firstDeserializer
        );

        $this->deserializerLocator->registerDeserializer(
            new String('application/vnd.cultuurnet.bar'),
            $anotherDeserializer
        );

        $this->assertSame(
            $firstDeserializer,
            $this->deserializerLocator->getDeserializerForContentType(
                new String('application/vnd.cultuurnet.foo')
            )
        );

        $this->assertSame(
            $anotherDeserializer,
            $this->deserializerLocator->getDeserializerForContentType(
                new String('application/vnd.cultuurnet.bar')
            )
        );
    }

    public function testThrowsExceptionWhenDeserializerCanNotBeFound()
    {
        $this->setExpectedException(
            JSONDeserializerNotFoundException::class
        );

        $this->deserializerLocator->getDeserializerForContentType(
            new String('application/vnd.cultuurnet.something-else')
        );
    }
}
