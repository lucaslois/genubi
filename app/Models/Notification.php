<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'text',
        'image',
        'link',
        'viewed',
        'clicked',
        'code'
    ];

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }
}
