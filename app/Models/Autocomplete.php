<?php

namespace App\Models;

class Autocomplete
{
    public static function format($text) {
        $regex = preg_match_all("(@[a-zA-Z0-9\-\#]*)", $text, $group);
        $new = $text;

        foreach($group[0] as $mention) {
            $tag = self::search($mention);
            if(!$tag) continue;
            $taggable = $tag->taggable;
            $link = "<a href='{$taggable->formattedLink()}'><img class='mini-image'src='".$taggable->getImage()."' /> {$taggable->getName()}</a>";
            $new = str_replace($mention, "$link", $new);
        }
        return $new;
    }

    public static function search($slug) {
        $word = str_replace("@", "", $slug);
        $tag = Tag::where('tag', "$word")->first();

        return $tag;
    }
}
