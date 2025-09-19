<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'states';

    protected $primaryKey = 'state_id';

    protected $guarded = [];

    protected $fillable = [
        'state_name',
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'state_id');
    }

    protected static function booted()
    {
        static::deleted(function (State $state) {
            $state->cities()->update(['op_status' => 9]);
            $state->cities()->delete();
        });

        static::restoring(function (State $state) {
            $state->cities()->onlyTrashed()->restore();
            $state->cities()->update(['op_status' => 1]);
        });
    }
}
