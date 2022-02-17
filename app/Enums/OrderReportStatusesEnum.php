<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 13.12.2021
 * Time: 14:24
 */

namespace App\Enums;


class OrderReportStatusesEnum
{
    const NEW_STATUS = 'new';
    const IN_PROCESS = 'in_process';
    const FINISHED = 'finished';

    const ALL_STATUSES = [
        self::NEW_STATUS,
        self::IN_PROCESS,
        self::FINISHED,
    ];
}
