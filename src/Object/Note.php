<?php
namespace App\Object;

use Exception as InvalidEntityDataException;
use DateTimeImmutable;

class Note implements \JsonSerializable
{
    private string $content;
    private ?array $contentTypes;
    private ?int $id;
    private DateTimeImmutable $createdOn;
    private DateTimeImmutable $updatedOn;

    private function __construct()
    {
        $this->id = null;
        $this->createdOn = new DateTimeImmutable();
        $this->updatedOn = new DateTimeImmutable();
    }
    public static function create(
        string $content,
        ?array $contentTypes
    ): self {
        $note = new self();
        $note->setContent($content);
        $note->setContentTypes($contentTypes);

        return $note;
    }

    public static function createFromArray(array $data): self
    {
        if (empty($data['id'])) {
            throw new InvalidEntityDataException('ID is required');
        }
        if (empty($data['content'])) {
            throw new InvalidEntityDataException('Content is required');
        }

        $post = new self();
        $post->id = $data['id'];
        $post->content = $data['content'];
        $post->contentTypes = $data['contentTypes'] ?? null;
        $post->createdOn = new DateTimeImmutable($data['createdOn']);
        $post->updatedOn = new DateTimeImmutable($data['updatedOn']);

        return $post;
    }

    public function jsonSerialize()
    {
        return ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getContentTypes(): ?array
    {
        return $this->contentTypes;
    }

    public function setContentTypes(?array $contentTypes)
    {
        $this->contentTypes = $contentTypes;
    }

}