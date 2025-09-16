<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class State extends Model
{

    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = "states";
    protected $primaryKey = 'state_id';
    protected $guarded = [];
    protected $fillable = [
        'state_name',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable() 
            ->logOnlyDirty(); 
    }
    
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id');
    }

    protected static function booted(){
    static::deleted(function(State $state){
      $state->cities()->update(['op_status' => 9]);
      $state->cities()->delete();
     });

     static::restoring(function(State $state){
      $state->cities()->onlyTrashed()->restore();
      $state->cities()->update(['op_status' => 1]);
     });
    }
}
