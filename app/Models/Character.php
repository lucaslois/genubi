<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model implements CanParticipateInChannel
{
    use XpTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'family',
        'race',
        'age',
        'description',
        'nationality',
        'color'
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

    public function classes() {
        return $this->hasMany('App\\Models\\CharacterClass');
    }

    public function experiences() {
        return $this->hasMany('App\\Models\\CharacterExperience')->orderByDesc('id');
    }

    public function state() {
        return $this->belongsTo('App\\Models\\CharacterState');
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
