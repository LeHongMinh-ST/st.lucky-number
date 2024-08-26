<?php

namespace App\Helpers;

class Helpers
{
    public static function formatNumber($number) {
        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }
}
