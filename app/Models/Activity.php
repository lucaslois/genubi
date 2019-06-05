<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'text',
        'formatted_text'
    ];

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public static function send(User $user, $formatted_text) {
        return Activity::create([
            'user_id' => $user->id,
            'formatted_text' => $formatted_text,
            'text' => strip_tags($formatted_text)
        ]);
    }
}
