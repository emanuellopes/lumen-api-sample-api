<?php

namespace App\Repository\Eloquent;

use App\Models\Author;
use App\Repository\Eloquent\Contracts\AuthorRepository as AuthorRepositoryImpl;

class AuthorRepository extends BaseRepository implements AuthorRepositoryImpl
{
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }
}
