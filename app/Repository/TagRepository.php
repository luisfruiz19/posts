<?php


namespace App\Repository;


use App\Models\Tag;

class TagRepository
{
    public function getAll(): array
    {
        $tags = Tag::query();
        return $tags->get()->toArray();
    }
}
