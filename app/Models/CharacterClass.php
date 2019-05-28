<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterClass extends Model
{
    protected $fillable = [
        'name',
        'level',
        'character_id'
    ];
}
