<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
class Tag extends Model
{
    protected $table = "tags";

    protected $fillable = ['name', 'slug'];

    public function articles()
    {
        // return $this->belongsToMany(Article::class, 'articles_tags', 'article_id', 'tag_id');
        return $this->belongsToMany(Article::class ,'articles_tags');
    }

    public function getArticlesCountAttribute()
    {
        return $this->articles->count();
    }
}
