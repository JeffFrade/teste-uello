<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function parseDateTime(string $date)
    {
        return Carbon::parse($date)->toDateTimeString();
    }
}
