<?php


namespace App\Models;


interface CanBeFormatted
{
    public function generateSlug();
    public function formattedLink();
}