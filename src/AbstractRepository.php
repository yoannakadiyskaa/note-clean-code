<?php


namespace App;

abstract class AbstractRepository
{
    private ?array $objects = null;

    abstract protected function getCollectionFileName(): string;

    protected function getCollection(): array
    {
        if (is_null($this->objects)) {
            $data = file_get_contents($this->getFullFilePath());

            $this->objects = json_decode($data) ?? [];
        }
        return $this->objects;
    }

    protected function addToCollection(\JsonSerializable $data)
    {
        $this->objects[] = $data;
    }

    protected function saveCollection()
    {
        $encodedCollection = array_map(function (\JsonSerializable $collectionEntry) {
            return $collectionEntry->jsonSerialize();
        }, $this->getCollection());

        file_put_contents($this->getFullFilePath(), $encodedCollection);
    }

    private function getFullFilePath(): string
    {
        return BASE_DIR . '/data/' . $this->getCollectionFileName();
    }
}