<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }
}
