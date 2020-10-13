<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Userbackup extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function messages(){
        
        return $this->hasMany('\App\Message');
    }

    public function comments(){

        return $this->hasMany(Comment::class);
    }

    public function posts(){

        return $this->hasMany(Posts::class);
    }

    function publish(Posts $post){
        $this->posts()->save($post);

        // Posts::create([
        //     'title'=>request('title'),
        //     'body'=>request('body'),
        //     'user_id'=> auth()->id()
        //     ]);
    }

    function following(){

        return $this->BelongsToMany('\App\User','followers','user_id', 'following_id');
    }
    
    function isFollowing($user){
        //dd($user->id);
        //dd($this->following()->where('following_id', 2)->count());
        return $this->following()->where('following_id', $user->id)->count();
    }
}
