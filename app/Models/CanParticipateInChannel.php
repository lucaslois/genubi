<?php


namespace App\Models;


interface CanParticipateInChannel
{
    public function getName();
    public function getImage();
    public function getColor();
}