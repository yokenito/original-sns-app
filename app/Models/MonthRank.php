<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthRank extends Model
{
    use HasFactory;

    public function monthrank_users(){
        return $this->hasMany(ManthRank_User::class);
    }
}
