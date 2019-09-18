<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function morph() {
        return $this->morphTo('articable');
    }

    public function isDM() {
        return $this->user->is($this->campaign->user);
    }

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }
    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }
    public function characters() {
        return $this->belongsToMany('App\\Models\\Character', 'knowledge_character');
    }

    public function notifyAllUsers() {
        foreach($this->characters as $character_to_share) {
            $user = $character_to_share->user;
            $owner = $this->user;
            $character = $this->character;

            $link = route('knowledges.show', $this->id);

            $user->sendNotification(
                "share_knowledge_$this->id",
                "{$owner->name} le ha compartido el conocimiento {$this->name} a {$character->name}",
                $user->getImage(),
                $link);
        }
    }
}
