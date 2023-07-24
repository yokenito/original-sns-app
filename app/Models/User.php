<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nicecount_post',
        'funnycount_post',
        'movingcount_post'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function userlogs(){
        return $this->hasMany(Userlog::class);
    }
    public function user_usertitles(){
        return $this->hasMany(User_Usertitle::class);
    }
    public function monthrank_user(){
        return $this->hasMany(Monthrank_User::class);
    }

    // お気に入り用
    public function nices(){
        return $this->belongsToMany(Post::class,'nices')->withTimestamps();
    }
    public function isNice($post_id){
        return $this->nices()->where('post_id',$post_id)->exists();
    }
    public function nice($post_id){
        if($this->isNice($post_id)){
            $this->nices()->detach($post_id);
        } else {
            $this->nices()->attach($post_id);
        }
    }
}
