<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Address
 * @package App\Models
 *
 * @property integer $id
 * @property string $country
 * @property string $city
 * @property string $region
 * @property string $flat
 * @property string $postal_code
 * @property float $lat
 * @property float $lng
 * @property boolean $is_default
 * @property User $user
 */
class Address extends Model
{
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'country',
        'city',
        'street',
        'region',
        'flat',
        'postal_code',
        'lat',
        'lng',
        'is_default',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
