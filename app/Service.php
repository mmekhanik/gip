<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Service extends Model
{
    protected $guarded = [];

    public function getRouteKeyName(){
        return "slug";
    }

    public function price(){
       return money_format('%i',$this->price);
    }
    public function scopePublished($query)
    {
        return $query->where('is_published', 1)->whereNotNull("published_at")->where('published_at', '<', Carbon::now())->orderBy('level', 'asc');
    }
}
