<?php

namespace CultuurNet\UDB2DomainEvents;

use Broadway\Serializer\SerializableInterface;
use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

abstract class AbstractActorEvent implements SerializableInterface
{
    use HasActorIdTrait, HasAuthoringMetadataTrait, HasUrlTrait {
        HasActorIdTrait::serialize as serializeActorId;
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
        $this->setActorId($actorId);
        $this->setTime($time);
        $this->setAuthor($author);
        $this->setUrl($url);
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return $this->serializeActorId() +
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
            new StringLiteral($data['actorId']),
            ISO8601DateTimeDeserializer::deserialize(
                new StringLiteral($data['time'])
            ),
            new StringLiteral($data['author']),
            Url::fromNative($data['url'])
        );
    }
}
