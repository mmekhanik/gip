<?php

namespace App;
use Carbon\Carbon;

// use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // protected $fillable=['title', 'body'];
    // protected $guarded=[];
    public function comments(){

    	return $this->hasMany(Comment::class);
    }

    public function addComment($body){

    
    	$this->comments()->create([
            'body'=>$body,
            'user_id'=> auth()->id()

            ]);

    	// Comment::create([
    	// 	'body'=> $body,
    	// 	'posts_id'=>$this->id

    	// ]);
	}

	public function user(){
        return $this->belongsTo(User::class);

    }

    public function getRouteKeyName(){

        return "slug";

    }
    public function scopeFilter($query, $filters = []){
        if(!empty($filters)){
            if($month=$filters['month']){
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }
            if($year=$filters['year']){
                $query->whereYear('created_at', $year);
            }
        }
    }

    public static function archives(){

        return static::selectRaw('count(*) as published, to_char(created_at, \'YYYY\') as year, to_char(created_at, \'MONTH\') as month')
                 ->groupBy('year', 'month')
                 ->orderByRaw('min(created_at) desc')
                 ->get()
                 ->toArray();

    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public static function recentPost(){

        return Posts::latest()->paginate(2);
    }

}
