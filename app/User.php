<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Models\Article;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name','display_name',
            'slug',
            'address',
            'postcode',
            'town',
            'country',
            'phone',
            'bio',
            'job',
            'date_of_birth',
            'facebook_name',
            'twitter_name',
            'linkedin_name',
            'github_name',
            'website_url'
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

    public function getDisplayName()
    {
        if (!empty($this->display_name)) {
            return $this->display_name;
        }
        if (!empty($this->name)) {
            return $this->name;
        }
        return $this->email;
    }
    public function getTheHighestRoleId()
    {
        $highestRole = $this->roles->sortByDesc('permissions_level')->first();
        return ($highestRole && $highestRole->id) ? $highestRole->id : " ";
    }

    public function getRoleDisplayName()
    {
        if (count($this->roles)> 0)
            return $this->roles->sortByDesc('permissions_level')->first()->display_name;
        else
            return "<span class='text-danger'>No role set yet</span>"; 
    }
    // public function roles()
    // {
    //     return $this->belongsToMany('App\Models\Role', 'role_user');
    // }

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

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Article::class, 'favourites');
    }

    public function scopeFavouritesArticles($query)
    {
        return $this->favourites();
    }
}
