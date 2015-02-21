<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class SimpleDeserializerLocatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleDeserializerLocator
     */
    protected $deserializerLocator;

    public function setUp()
    {
        $this->deserializerLocator = new SimpleDeserializerLocator();
    }

    public function testGivesBackDeserializerThatWasRegistered()
    {
        $firstDeserializer = $this->getMock(DeserializerInterface::class);
        $anotherDeserializer = $this->getMock(DeserializerInterface::class);

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
            DeserializerNotFoundException::class
        );

        $this->deserializerLocator->getDeserializerForContentType(
            new String('application/vnd.cultuurnet.something-else')
        );
    }
}
