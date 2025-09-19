<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAction extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'resource_type',
        'resource_id',
        'details',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
