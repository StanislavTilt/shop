<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class OrderProduct
 * @package App\Models
 */
class OrderProduct extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'quantity',
        'price',
        'product_id',
        'product_option_id',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return MorphToMany
     */
    public function options(): MorphToMany
    {
        return $this->morphToMany(AttributeOption::class, 'optionable');
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return float|int
     */
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * @return BelongsTo
     */
    public function productOption()
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id');
    }
}
