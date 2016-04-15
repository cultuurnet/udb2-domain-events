<?php

namespace CultuurNet\UDB2DomainEvents;

use DateTime;
use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

trait HasActorIdTrait
{

    /**
     * @var StringLiteral
     */
    private $actorId;

    /**
     * @param StringLiteral $actorId
     */
    private function setActorId(StringLiteral $actorId)
    {
        if ($actorId->isEmpty()) {
            throw new \InvalidArgumentException('actor id can not be empty');
        }
        $this->actorId = $actorId;
    }

    /**
     * @return StringLiteral
     */
    public function getActorId()
    {
        return $this->actorId;
    }


    public function serialize()
    {
        return [
            'eventId' => (string) $this->getActorId(),
            'time' => $this->getTime()->format(DateTime::ISO8601),
            'author' => (string) $this->getAuthor(),
            'url' => (string) $this->getUrl(),
        ];
    }

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
