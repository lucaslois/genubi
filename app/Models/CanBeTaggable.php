<?php


namespace App\Models;


interface CanBeTaggable
{
    public function getName();
    public function getType();
    public function getImage();
    public function getCampaign();
    public function generateSlug();
    public function formattedLink();
}