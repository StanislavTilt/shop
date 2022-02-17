<?php

namespace App\Enums;


/**
 * Class AdminStatusesEnum
 * @package App\Enums
 */
class AdminStatusesEnum
{
    const ACTIVE = 'active';

    const DISABLED = 'disabled';

    const BANNED = 'banned';

    const ALL_STATUSES = [
        self::ACTIVE,
        self::DISABLED,
        self::BANNED,
    ];
}
