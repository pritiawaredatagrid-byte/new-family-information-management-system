<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "UserRegistration";
    protected $guarded = []; 
    public function members()
    {
        return $this->hasMany(Member::class, 'head_id');
    }

    protected static function booted(){
    static::deleted(function(UserRegistration $user){
      $user->members()->update(['op_status' => 9]);
      $user->members()->delete();
     });

     static::restoring(function(UserRegistration $user){
      $user->members()->onlyTrashed()->restore();
      $user->members()->update(['op_status' => 1]);
     });
    }
}



