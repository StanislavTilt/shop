<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LocationSetting
 * @package App\Models
 */
class LocationSetting extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'location_settings';

    /**
     * @var array
     */
    protected $fillable = [
        'location_id',
        'kilogram_price',
        'allowance',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }
}
