<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryCostForecast
 * @package App\Models
 */
class DeliveryCostForecast extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'delivery_cost_forecast';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'region',
        'cost',
    ];
}
