<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function posts(){
        return $this->belongsToMany(Posts::class);
    }

    public function getRouteKeyName(){
        return 'name';
    }
}
