<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Npc extends Model implements CanParticipateInChannel
{
    use SoftDeletes;

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

    public function getName()
    {
        return $this->name;
    }

    public function getColor()
    {
        return $this->color;
    }
}
