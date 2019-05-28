<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class ChannelPost extends Model
{
    protected $fillable = [
        'campaign_id',
        'user_id',
        'npc_id',
        'text',
    ];

    public function channel() {
        return $this->belongsTo('App\\Models\\Channel');
    }

    public function character() {
        return $this->belongsTo('App\\Models\\Character');
    }

    public function npc() {
        return $this->belongsTo('App\\Models\\Npc');
    }

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function participant() : CanParticipateInChannel {
        if($this->character)
            return $this->character;
        if($this->npc)
            return $this->npc;

        throw new Exception("Participant '$this->character_id' is not defined");
    }
}
