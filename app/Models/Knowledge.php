<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model implements CanBeTaggable
{
    use HasFormattedText, Taggable;

    protected $table = 'knowledges';

    protected $fillable = [
        'campaign_id',
        'character_id',
        'user_id',
        'name',
        'text',
        'share_everyone'
    ];

    public function user() {
        return $this->belongsTo('App\\Models\\User');
    }

    public function character() {
        return $this->belongsTo('App\\Models\\Character');
    }

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }

    public function characters() {
        return $this->belongsToMany('App\\Models\\Character', 'knowledge_character');
    }

    public function isDM() {
        return $this->user->is($this->campaign->user);
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

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return "Conocimiento";
    }

    public function getImage()
    {
        return asset('images/icon_book.png');
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
        return route('knowledges.show', $this->id);
    }
}
