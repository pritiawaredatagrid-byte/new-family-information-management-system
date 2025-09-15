<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "members";
    protected $guarded = []; 
    
    protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo(UserRegistration::class, 'head_id');
    }

}