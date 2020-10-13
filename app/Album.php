<?php

namespace App;
use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = [];

    public function getRouteKeyName(){
        
        return "slug";

    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function gallery(){
        return $this->hasMany(Photo::class);
    }

    public function scopeFilter($query, $filters = []){
        // if(!empty($filters)){
        //     if($id=$filters['id']){
        //         $query->whereMonth('created_at', Carbon::parse($month)->month);
        //     }
        // }
    }
}
