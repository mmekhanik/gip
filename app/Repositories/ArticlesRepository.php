<?php namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\ArticlesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ArticlesRepository implements ArticlesRepositoryInterface
{
    public function search(string $query = ''): Collection
    {
        return Article::query()
            ->where('content', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->orWhere('subtitle', 'like', "%{$query}%")
            ->get();
    }
}