<?php

namespace App\repository;

use App\AbstractRepository;
use App\Object\Note;

class NoteRepository extends AbstractRepository
{
    function getCollectionFileName(): string
    {
        return 'note.txt';
    }

    public function listAll()
    {
        $notesDataList = $this->getCollection();
        return array_map([Note::class, 'createFromArray'], $notesDataList);
    }

    public function find(int $id)
    {
        $notesDataList = $this->getCollection();
        $noteData =  array_filter($notesDataList, function ($note) use ($id) {
            return $note['id'] == $id;
        });

        return Note::createFromArray($noteData);
    }

    public function save(Note $note)
    {
        $this->addToCollection($note);
        $this->saveCollection();
    }

}