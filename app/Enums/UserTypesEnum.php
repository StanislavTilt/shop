<?php

namespace App\Enums;

class UserTypesEnum
{

    const ADMIN_USER = 'admin';

    const SUPER_ADMIN = 'super-admin';

    const ADMIN_ROLES = [
        self::ADMIN_USER,
        self::SUPER_ADMIN,
    ];
}
