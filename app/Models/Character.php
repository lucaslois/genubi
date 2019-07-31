<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Character extends Model implements CanParticipateInChannel, CanBeFormatted
{
    use XpTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'family',
        'race',
        'age',
        'description',
        'nationality',
        'color',
        'state_id',
        'desc_mentality',
        'desc_appearance',
        'desc_social_status',
        'famous_phrase'
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
        return $this->belongsTo('App\\Models\\CharacterState', 'state_id');
    }

    public function posts() {
        return $this->hasMany('App\\Models\\SessionPost');
    }

    public function getName()
    {
        return $this->name;
    }

    public function getColor()
    {
        return $this->color;
    }


    // CAN BE FORMATTED INTERFACE
    public function generateSlug() {
        return Str::slug($this->name) . $this->id;
    }

    public function formattedLink() {
        return route('characters.show', $this->id);
    }
}
