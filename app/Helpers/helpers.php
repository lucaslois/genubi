<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

if (!function_exists('mile_separator')) {
    /**
     * @param Model $model1
     * @param Model $model2
     * @return string a string in human readable format
     */
    function mile_separator($number)
    {
        if($number == null) return null;
        return number_format($number, 0, '.', ',');
    }
}

function usersOnline() {
    $users = User::usersOnline();

    return $users;
}
