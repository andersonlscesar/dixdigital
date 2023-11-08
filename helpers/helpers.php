<?php

use Carbon\Carbon;

if (!function_exists('dateToString')) {
    function dateToString( $date ): string
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}

if (!function_exists('countTimeForHumans')) {
    function countTimeForHumans( $date ): string
    {
        return Carbon::parse( $date )->diffForHumans();
    }
}