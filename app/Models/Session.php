<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'text',
        'date',
        'campaign_id'
    ];

    protected $dates = ['date'];

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public function npcs() {
        return $this->belongsToMany('App\\Models\\Npc', 'session_npcs');
    }

    public function enemies() {
        return $this->belongsToMany('App\\Models\\Npc', 'session_enemies');
    }

    public function milestones() {
        return $this->hasMany('App\\Models\\Milestone');
    }

    public function posts() {
        return $this->hasMany('App\\Models\\SessionPost');
    }

    public function getImage() {
        if($this->background_image)
            return asset($this->background_image);

        return asset('images/default_session.jpg');
    }

    public function positives() {
        return $this->hasMany('App\\Models\\SessionVote')->where('vote', 1)->get();
    }

    public function negatives() {
        return $this->hasMany('App\\Models\\SessionVote')->where('vote', -1)->get();
    }

    public function visites() {
        return $this->belongsToMany('App\\Models\\User', 'session_visites');
    }
}
