<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    protected $table = "members";
    protected $guarded = []; 
    
    protected $primaryKey = 'id';

     public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable() 
            ->logOnlyDirty(); 
    }
    
    public function user()
    {
        return $this->belongsTo(UserRegistration::class, 'head_id');
    }

}