<?php

namespace App\Enums;

use App\Models\User;

/**
 * Class UserStatusesEnum
 * @package App\Enums
 */
class UserStatusesEnum
{
    /**
     *
     */
    const STATUSES = [
        User::STATUS_ACTIVE => 'active',
        User::STATUS_NOT_VERIFIED => 'not_verified',
        User::STATUS_BANNED => 'banned',
    ];
}
