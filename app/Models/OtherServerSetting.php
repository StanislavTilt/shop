<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OtherServerSetting
 * @package App\Models
 */
class OtherServerSetting extends Model
{
    use HasFactory;

    /**
     *
     */
    const ARCHIVE_REMOVAL_DAYS = 'archive_removal_days';

    /**
     *
     */
    const CURRENCY_CONVERSION_COMMISSION = 'currency_conversion_commission';

    /**
     *
     */
    const VALIDATION_REQUEST_LIFETIME = 'validation_request_lifetime';

    /**
     * @var string
     */
    protected $table = 'other_server_settings';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'key',
        'value',
    ];

    /**
     * @param $key
     * @return mixed
     */
    public static function getSettingValue($key)
    {
        if (is_array($key)) {
            return self::whereIn('key', $key)->pluck('value');
        } else {
            return self::where('key', $key)->first()->value;
        }
    }
}
