<?php

namespace App\Models;

class Autocomplete
{
    public static function format($text) {
        $regex = preg_match_all("(@[a-zA-Z0-9]*)", $text, $group);
        $new = $text;

        foreach($group[0] as $mention) {
            $character = self::search($mention);
            if(!$character) continue;
            $link = "<a href='{$character->formattedLink()}'><img class='mini-image'src='".$character->getImage()."' /> $character->name</a>";
            $new = str_replace($mention, "$link", $new);
        }
        return $new;
    }

    public static function search($slug) {
        $word = str_replace("@", "", $slug);
        $character = Character::whereSlug("$word")->first();
        if($character)
            return $character;
        $npc = Npc::whereSlug("$word")->first();
        if($npc)
            return $npc;

        return null;
    }
}
