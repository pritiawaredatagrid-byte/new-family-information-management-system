<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
    protected $table = "UserRegistration";
    public function members()
    {
        return $this->hasMany(Member::class, 'head_id');
    }
}



