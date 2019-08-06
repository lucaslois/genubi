<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Npc extends Model implements CanParticipateInChannel, CanBeFormatted
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'text',
        'color',
        'campaign_id',
    ];

    public function getImage() {
        if($this->avatar)
            return asset($this->avatar);

        return asset('images/avatar.png');
    }

    public function campaign() {
        return $this->belongsTo('App\\Models\\Campaign');
    }

    public function getName()
    {
        return $this->name;
    }

    public function getColor()
    {
        return $this->color;
    }

    // CAN BE FORMATTED INTERFACE
    public function generateSlug() {
        return Str::slug($this->name) . $this->id;
    }
    public function formattedLink() {
        return route('npcs.show', $this->id);
    }
    public function formattedText() {
        return Autocomplete::format($this->text);
    }
}
