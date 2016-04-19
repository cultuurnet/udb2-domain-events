<?php

namespace CultuurNet\UDB2DomainEvents;

use Broadway\Serializer\SerializableInterface;
use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

abstract class AbstractEventEvent implements SerializableInterface
{
    use HasEventIdTrait, HasAuthoringMetadataTrait, HasUrlTrait {
        HasEventIdTrait::serialize as serializeEventId;
        HasAuthoringMetadataTrait::serialize as serializeAuthoringMetadata;
        HasUrlTrait::serialize as serializeUrl;
    }

    /**
     * @param StringLiteral $actorId
     * @param \DateTimeImmutable $time
     * @param StringLiteral $author
     * @param Url $url
     */
    public function __construct(
        StringLiteral $actorId,
        \DateTimeImmutable $time,
        StringLiteral $author,
        Url $url
    ) {
        $this->setEventId($actorId);
        $this->setTime($time);
        $this->setAuthor($author);
        $this->setUrl($url);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return $this->serializeEventId() +
            $this->serializeAuthoringMetadata() +
            $this->serializeUrl();
    }

    /**
     * @param array $data
     * @return static
     */
    public static function deserialize(array $data)
    {
        return new static(
            new StringLiteral($data['eventId']),
            ISO8601DateTimeDeserializer::deserialize(
                new StringLiteral($data['time'])
            ),
            new StringLiteral($data['author']),
            Url::fromNative($data['url'])
        );
    }
}
