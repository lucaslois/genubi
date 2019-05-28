<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model implements CanParticipateInChannel
{
    use XpTrait;

    protected $fillable = [
        'name',
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

    public function getName()
    {
        return $this->name;
    }

    public function getColor()
    {
        return $this->color;
    }
}
