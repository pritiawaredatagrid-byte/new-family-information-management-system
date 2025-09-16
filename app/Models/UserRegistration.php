<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UserRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable() 
            ->logOnlyDirty(); 
    }

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



