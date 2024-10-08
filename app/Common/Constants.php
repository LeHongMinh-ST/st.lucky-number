<?php

declare(strict_types=1);

namespace App\Common;

class Constants
{
    public const FORMAT_DATE = 'd-m-Y';

    public const FORMAT_DATE_TIME = 'd-m-Y H:i:s';

    public const FORMAT_TIME = 'H:i';

    public const FORMAT_DATE_TIME_API = 'Y-m-d\TH:i:s';

    public const TEAM_IMAGE_DEFAULT = 'assets/images/team.png';

    public const PER_PAGE_ADMIN = 10;

    public const PER_PAGE = 10;

    public const PER_PAGE_SEMINAR = 5;

    public const ROOM_NAME = 'Phòng 304 - Toà nhà C';

    public const YEAR = [
        2024,
        2023,
        2022,
        2021,
        2020,
        2019,
        2018,
        2017,
    ];

    public const REGEX_PHONE_NUMBER = '/^(0|\+84|84)?(3[2-9]|5[2689]|7[06-9]|8[1-689]|9[0-46-9])[0-9]{7}$/';
}
