<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postImgs(){
        return $this->hasMany(PostImg::class);
    }

    public function stamps(){
        return $this->belongsToMany(Stamp::class)->withTimestamps();
    }

    public function stampuser(){
        return $this->belongsTo(User::class,'post_stamp');
    }

    public function nices(){
        return $this->belongsToMany(User::class,'nices')->withTimestamps();
    }

    public function isfunnyStamp($user_id){
        return $this->stamps()->where('stamp_id',1)->where('user_id',$user_id)->exists();
    }
    public function isshineStamp($user_id){
        return $this->stamps()->where('stamp_id',2)->where('user_id',$user_id)->exists();
    }
}
