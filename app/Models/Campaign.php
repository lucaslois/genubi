<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model implements CanBeTaggable
{
    use SoftDeletes, Taggable;

    protected $fillable = [
        'name',
        'description',
        'short_description',
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

    public function inactiveCharacters() {
        return $this->characters()->where('state_id', '!=', 1)->get();
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

    public function knowledges() {
        return $this->hasMany('App\\Models\\Knowledge');
    }

    public function usersPlaying() {
        return $this->characters->map(function($character) {
            return $character->user;
        })->unique('id');
    }

    public function getImage() {
        if($this->background_image)
            return asset($this->background_image);

        return asset('images/default_campaign.jpg');
    }

    public function getImageMini() {
        if($this->background_image_mini)
            return asset($this->background_image_mini);

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

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return "Campaña";
    }

    public function getCampaign()
    {
        return null;
    }

    public function generateSlug()
    {
        return str_slug($this->name) . "#" . $this->id;
    }

    public function formattedLink()
    {
        return route('campaigns.show', $this->id);
    }
}
