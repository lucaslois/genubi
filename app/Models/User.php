<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function campaigns() {
        return $this->hasMany('App\\Models\\Campaign');
    }

    public function characters() {
        return $this->hasMany('App\\Models\\Character');
    }

    public function channels() {
        return $this->hasMany('App\\Models\\Channel');
    }

    public function sessionVotes() {
        return $this->hasMany('App\\Models\\SessionVote');
    }

    public function sessionPosts() {
        return $this->hasMany('App\\Models\\SessionPost');
    }

    public function notifications() {
        return $this->hasMany('App\\Models\\Notification')->orderByDesc('id');
    }

    public function viewedNotifications() {
        return $this->notifications()->whereViewed(1)->get();
    }

    public function notViewedNotifications() {
        return $this->notifications()->whereViewed(0)->get();
    }

    public function isPlayingCampaign(Campaign $campaign) {
        foreach($this->characters as $character)
            if($character->campaign->is($campaign))
                return true;

        return false;
    }

    public function getImage() {
        if($this->avatar)
            return asset($this->avatar);
        return asset('images/avatar.png');
    }
}
