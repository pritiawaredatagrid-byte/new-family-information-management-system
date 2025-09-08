<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "states";
    protected $primaryKey = 'state_id';
    protected $fillable = [
        'state_name',
    ];
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id');
    }
}
