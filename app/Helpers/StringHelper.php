<?php

namespace App\Helpers;

class StringHelper
{
    public static function removeSpecialChars(string $string)
    {
        return preg_replace('/\W/', '', $string);
    }
}
