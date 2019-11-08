<?php


namespace App\Models;


trait HasFormattedText
{
    public function formattedText() {
        return Autocomplete::format($this->text);
    }
}
