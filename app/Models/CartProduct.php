<?php

namespace App\Models;

use App\Models\Pivot\Optionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class CartProduct
 * @package App\Models
 */
class CartProduct extends Model
{
    /**
     * @var string
     */
    protected $table = "cart_products";

    /**
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'product_option_id'
    ];

    /**
     * @return BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsToMany
     */
    public function options(): BelongsToMany
    {
        return $this->morphToMany(AttributeOption::class, 'optionable')->withPivot('quantity');
    }

    /**
     * @return BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'optionables', 'optionable_id')->distinct();
    }

    /**
     * @return BelongsTo
     */
    public function productOption()
    {
        return $this->belongsTo(ProductOption::class);
    }
}
