<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionVote extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'vote'
    ];

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }
}
