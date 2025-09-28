<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\City;
use App\Models\UserRegistration;
use Illuminate\Support\Facades\File;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'states';
    protected $primaryKey = 'state_id';
    protected $guarded = [];
    protected $fillable = ['state_name', 'op_status'];

    public function cities()
    {
        return $this->hasMany(City::class, 'state_id');
    }

    protected static function booted()
    {
        static::deleted(function (State $state) {

            $state->op_status = 9;
            $state->save();


            $state->cities()->update(['op_status' => 9]);
            $state->cities()->delete();

            $familyHeads = UserRegistration::where('state', $state->state_name)->get();
            foreach ($familyHeads as $head) {


                if ($head->photo && File::exists(public_path('uploads/' . $head->photo))) {
                    File::delete(public_path('uploads/' . $head->photo));
                }

                $head->op_status = 0;
                $head->save();

                $head->members()->each(function ($member) {
                    if ($member->photo && File::exists(public_path('uploads/' . $member->photo))) {
                        File::delete(public_path('uploads/' . $member->photo));
                    }

                    $member->op_status = 0;
                    $member->save();

                    $member->delete();
                });

                $head->delete();
            }
        });

        static::restoring(function (State $state) {


            $state->op_status = 1;
            $state->save();


            $state->cities()->onlyTrashed()->restore();
            $state->cities()->update(['op_status' => 1]);

            $familyHeads = UserRegistration::withTrashed()->where('state', $state->state_name)->get();
            foreach ($familyHeads as $head) {
                $head->op_status = 1;
                $head->save();


                $head->members()->onlyTrashed()->restore();
                $head->members()->update(['op_status' => 1]);

                $head->restore();
            }
        });
    }
}

