<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SessionPost extends Model
{
    use HasFormattedText, SoftDeletes;

    protected $fillable = [
        'user_id',
        'character_id',
        'session_id',
        'title',
        'text'
    ];

    public function character() {
        return $this->belongsTo('App\\Models\\Character');
    }

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public function session() {
        return $this->belongsTo('App\\Models\\Session');
    }


}
