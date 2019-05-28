<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterExperience extends Model
{
    protected $fillable = [
        'user_id',
        'character_id',
        'session_id',
        'value',
        'reason'
    ];

    public function session() {
        return $this->belongsTo('App\\Models\\Session');
    }
}
