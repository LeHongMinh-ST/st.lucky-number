<?php

namespace App\Enums;

enum CampaignType: string
{
    case News = 'new';

    case Students = 'students';

    public static function getDescription($value): string
    {
//        $value = self::from($value);

        return match ($value) {
            self::News => 'Sinh viên chuẩn bị nhập học',
            self::Students => 'Tân sinh viên',
            default => '',
        };
    }
}
