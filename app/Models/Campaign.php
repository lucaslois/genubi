<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'description',
        'game_id',
        'mode_id',
        'state_id',
    ];

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public function mode() {
        return $this->belongsTo('App\\Models\\Mode');
    }

    public function game() {
        return $this->belongsTo('App\\Models\\Game');
    }

    public function state() {
        return $this->belongsTo('App\\Models\\CampaignState');
    }

    public function sessions() {
        return $this->hasMany('App\\Models\\Session')->orderByDesc('date');
    }

    public function characters() {
        return $this->hasMany('App\\Models\\Character')->orderBy('name');
    }

    public function activeCharacters() {
        return $this->characters()->whereStateId(1)->get();
    }

    public function npcs() {
        return $this->hasMany('App\\Models\\Npc');
    }

    public function homebrews() {
        return $this->hasMany('App\\Models\\Homebrew');
    }

    public function channels() {
        return $this->hasMany('App\\Models\\Channel')->orderByDesc('order');
    }

    public function getImage() {
        if($this->background_image)
            return asset($this->background_image);

        return asset('images/default_campaign.jpg');
    }

    public function positives() {
        $query = SessionVote::query();
        return $query->join('sessions', 'sessions.id', '=', 'session_votes.session_id')
                ->where('sessions.campaign_id', $this->id)
                ->where('session_votes.vote', 1)
                ->count();
    }

    public function negatives() {
        $query = SessionVote::query();
        return $query->join('sessions', 'sessions.id', '=', 'session_votes.session_id')
            ->where('sessions.campaign_id', $this->id)
            ->where('session_votes.vote', -1)
            ->count();
    }
}
