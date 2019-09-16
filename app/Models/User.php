<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements CanBeTaggable
{
    use Notifiable, Taggable;

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

    protected $dates = ['last_login'];

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
            if($character->campaign && $character->campaign->is($campaign))
                return true;

        return false;
    }

    public function getImage() {
        if($this->avatar)
            return asset($this->avatar);
        return asset('images/avatar.png');
    }

    public function activities() {
        return $this->hasMany('App\\Models\\Activity')->orderByDesc('id');
    }

    public function canCreateKnowledge(Campaign $campaign) {
        return $this->isPlayingCampaign($campaign) || $campaign->user->is($this);
    }

    public function knowledges() {
        return $this->hasMany('App\\Models\\Knowledge');
    }

    /**
     * @param Campaign $campaign
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function knowledgesOf(Campaign $campaign) {
        $list_of_characters = $this->characters->pluck('id');

        $query = $campaign->knowledges()->select('knowledges.*');
        $query->leftJoin('knowledge_character', 'knowledge_character.knowledge_id', '=', 'knowledges.id');
        $query->where(function($query) use($list_of_characters) {
            $query->orWhere('knowledges.user_id', $this->id)
                ->orWhere('knowledges.share_everyone', true)
                ->orWhereIn('knowledge_character.character_id', $list_of_characters);
        });

        return $query;
    }

    public function sendNotification($code, $text, $image, $link) {
        if($this->notifications()->whereCode($code)->count() > 0)
            return null;

        return Notification::create([
            'code' => $code,
            'user_id' => $this->id,
            'text' => $text,
            'image' => $image,
            'link' => $link
        ]);
    }

    public function isAdmin() {
        return $this->is_admin == true;
    }

    public static function usersOnline() {
        $users = User::all();

        return $users->filter(function($user) {
            return $user->isLogged();
        });
    }

    public function isLogged() {
        return Cache::has("$this->id:is-logged");
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return "Usuario";
    }

    public function getCampaign()
    {
        return null;
    }

    public function generateSlug()
    {
        return str_slug($this->name) . '#' . $this->id;
    }

    public function formattedLink()
    {
        return route('users.show', $this->id);
    }
}
