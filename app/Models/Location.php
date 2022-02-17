<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App\Models
 */
class Location extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'locations';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'currency_code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function country()
    {
        return $this->hasMany(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currencyCost()
    {
        return $this->hasOne(CurrencyCost::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function locationSetting()
    {
        return $this->hasOne(LocationSetting::class, 'location_id');
    }
}
