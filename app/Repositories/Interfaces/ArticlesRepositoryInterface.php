<?php namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ArticlesRepositoryInterface
{
    public function search(string $query = ''): Collection;
}