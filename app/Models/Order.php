<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'payment_type',
        'delivery_type',
        'delivery_address',
        'delivery_point_id',
        'status',
        'payment_time',
        'delivery_date',
        'delivery_status',
        'created_at',
        'order_uuid',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function orderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }



    /**
     * @return int|mixed
     */
    public function getTotalAttribute()
    {
        return $this->orderProduct->sum(function (OrderProduct $orderProduct) {
            return $orderProduct->total;
        });
    }

    /**
     * @return HasMany
     */
    public function orderChanges()
    {
        return $this->hasMany(OrderChange::class, 'order_id');
    }

    /**
     * @return HasMany
     */
    public function orderReports()
    {
        return $this->hasMany(OrderReport::class, 'order_id');
    }
}
