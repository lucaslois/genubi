<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model implements CanBeTaggable
{
    use HasFormattedText, Taggable;

    use SoftDeletes;
    protected $fillable = [
        'name',
        'campaign_id',
        'order',
        'text',
    ];

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public function posts() {
        return $this->hasMany('App\\Models\\ChannelPost');
    }

    public static function getLastOrder() {
        return Channel::orderByDesc('order')->first();
    }

    public function suscribedUsers() {
        return $this->belongsToMany('App\\Models\\User', 'channel_suscribers');
    }

    public function characters() {
        return $this->belongsToMany('App\\Models\\Character', 'channel_characters');
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return "Canal";
    }

    public function getImage()
    {
        return asset('images/icon_channel.png');
    }

    public function getCampaign()
    {
        return $this->campaign;
    }

    public function generateSlug()
    {
        return str_slug($this->name) . "#" . $this->id;
    }

    public function formattedLink()
    {
        return route('channels.show', $this->id);
    }
}
