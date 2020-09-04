<?php
namespace App\Service;

use App\Object\Note;
use App\Repository\NoteRepository;

class NoteService
{
    private NoteRepository $repository;

    public function __construct()
    {
        $this->repository = new NoteRepository();
    }

    public function listAll(): array
    {
        $notes = $this->repository->listAll();
        return $notes;
    }

    public function create(string $content): bool
    {
        $note = Note::create($content, []);
        $this->repository->save($note);
        return true;
    }

    public function get(int $id): Note
    {
        $note = $this->repository->find($id);
        if (! $note) {
            throw new \InvalidArgumentException("Note with id {$id} not found");
        }
        return $note;
    }
}