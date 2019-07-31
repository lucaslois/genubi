<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use HasFormattedText;

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
}
