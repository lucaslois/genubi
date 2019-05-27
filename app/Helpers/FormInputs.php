<?php

namespace app\Helpers;

use Illuminate\Database\Eloquent\Model;

if (!function_exists('selectedIfModelEquals')) {
    /**
     * @param Model $model1
     * @param Model $model2
     * @return string a string in human readable format
     */
    function selectedIfModelEquals(Model $model1, Model $model2)
    {
        if($model1->is($model2))
            return "selected";
        return "";
    }
}