<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'used_at'
    ];

    protected $dates = ['used_at'];

    public function user()
    {
        return $this->belongsTo('App\\Models\\User');
    }
}
