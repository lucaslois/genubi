<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag', 'name', 'campaign_id', 'active'
    ];

    public function taggable() {
        return $this->morphTo();
    }

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }
}
