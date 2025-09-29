<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class UserRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'UserRegistration';

    protected $guarded = [];

    public function members()
    {
        return $this->hasMany(Member::class, 'head_id');
    }

    protected static function booted()
    {
        static::deleted(function (UserRegistration $user) {

            if ($user->photo && File::exists(public_path('uploads/'.$user->photo))) {
                File::delete(public_path('uploads/'.$user->photo));
            }

            $user->members()->each(function ($member) {

                if ($member->photo && File::exists(public_path('uploads/'.$member->photo))) {
                    File::delete(public_path('uploads/'.$member->photo));
                }

                $member->op_status = 9;
                $member->save();

                $member->delete();
            });
        });

        static::restoring(function (UserRegistration $user) {
            $user->members()->onlyTrashed()->restore();
            $user->members()->update(['op_status' => 1]);
        });
    }
}
