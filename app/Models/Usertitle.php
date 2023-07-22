<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertitle extends Model
{
    use HasFactory;

    public function user_usertitles(){
        return $this->hasMany(User_Usertitle::class);
    }
}
