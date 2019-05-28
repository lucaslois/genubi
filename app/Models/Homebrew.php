<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homebrew extends Model
{
    protected $fillable = [
        'name',
        'text',
        'campaign_id'
    ];

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }
}
