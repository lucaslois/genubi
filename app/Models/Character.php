<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'name',
        'race',
        'age',
        'description',
        'nationality',
    ];

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public function getImage() {
        if($this->avatar)
            return asset($this->avatar);
        return asset('images/avatar.png');
    }

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }
}
