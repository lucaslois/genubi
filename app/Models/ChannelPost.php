<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelPost extends Model
{
    use SoftDeletes, HasFormattedText;

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
        return $this->belongsTo('App\\Models\\Character')->withTrashed();
    }

    public function npc() {
        return $this->belongsTo('App\\Models\\Npc')->withTrashed();
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

        throw new Exception("Participant with <Character $this->character_id> or <Npc $this->npc_id> is not defined");
    }
}
