<?php


namespace App\Models;


class Progress
{
    private static $progreso_experiencia = array(
        1 => 100,
        2 => 400,
        3 => 1000,
        4 => 2000,
        5 => 3500,
        6 => 5600,
        7 => 8400,
        8 => 12000,
        9 => 16500,
        10 => 22000,
        11 => 28600,
        12 => 36400,
        13 => 45000,
        14 => 56000,
        15 => 68000,
        16 => 81600,
        17 => 96900,
        18 => 114000,
        19 => 133000,
        20 => 190000,
        21 => 210000,
        22 => 231000,
        23 => 253000,
        24 => 276000,
        25 => 300000,
        26 => 325000,
        27 => 351000,
        28 => 378000,
        29 => 406000,
        30 => 435000
    );

    public static function get($num = null) {
        if($num !== null)
            return static::$progreso_experiencia[$num];
        return static::$progreso_experiencia;
    }
}