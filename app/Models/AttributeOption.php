<?php

namespace App\Models;

use App\Models\Pivot\Optionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AttributeOption
 * @package App\Models
 */
class AttributeOption extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'value',
        'order',
        'key',
        'attribute_id'
    ];

    /**
     * @return BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return BelongsToMany
     */
    public function cartProducts(): BelongsToMany
    {
        return $this->morphedByMany(CartProduct::class, 'optionable')->using(Optionable::class)->withPivot('quantity');
    }

    /**
     * @return MorphToMany
     */
    public function orderProducts(): MorphToMany
    {
        return $this->morphedByMany(OrderProduct::class, 'optionable')->using(Optionable::class)->withPivot('quantity');
    }

    /**
     * @return MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'optionable')->using(Optionable::class)->withPivot('quantity');
    }

    /**
     * @return HasOne
     */
    public function optionable(): HasOne
    {
        return $this->hasOne(Optionable::class);
    }
}
