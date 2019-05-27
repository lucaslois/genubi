<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Npc extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'campaign_id',
    ];

    public function getImage() {
        if($this->avatar)
            return asset($this->avatar);

        return asset('images/avatar.png');
    }

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }
}
