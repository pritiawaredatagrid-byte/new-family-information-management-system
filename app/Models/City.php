<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    protected $table = "cities";
    protected $guarded = [];
    protected $primaryKey = 'city_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable() 
            ->logOnlyDirty(); 
    }
    
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}


