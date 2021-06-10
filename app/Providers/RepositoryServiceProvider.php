<?php

namespace App\Providers;

use App\Repository\Eloquent\AuthorRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\Contracts\AuthorRepository as AuthorRepositoryImpl;
use App\Repository\Eloquent\Contracts\EloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepository::class, BaseRepository::class);
        $this->app->bind(AuthorRepositoryImpl::class, AuthorRepository::class);
    }

}
