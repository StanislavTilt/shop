<?php

namespace App\Models;

use App\Models\Pivot\Optionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Product
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property double $old_price
 * @property double $price
 * @property int $quantity
 * @property Brand $brand
 * @property Tag $tags
 * @property Attribute $attributes
 */
class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasEagerLimit;

    /**
     *
     */
    const STATUS_ACTIVE = 1;
    /**
     *
     */
    const STATUS_DEACTIVE = 0;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'old_price',
        'price',
        'quantity',
        'status',
        'brand_id',
        'purchase_price',
        'purchase_price_currency',
        'region',
        'weight',
        'vendor_id',
        'features',
        'removal_time',
    ];

    /**
     *
     */
    public function deleteRelations()
    {
        $this->productTags()->delete();
        $this->productSeasons()->delete();
        $this->categories()->delete();
        $this->storefronts()->delete();
        $this->promotions()->delete();
        $this->adminProduct()->delete();
    }

    /**
     * @var array
     */
    protected $casts = [
        'removal_time' => 'datetime',
        'features' => 'array'
    ];
    /**
     *
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('productImage')
            ->useDisk('products');
    }

    /**
     * @return BelongsToMany
     */
    public function options(): BelongsToMany
    {
        return $this->morphToMany(AttributeOption::class, 'optionable')->withPivot('quantity');
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CategoryProduct::class);
    }

    /**
     * @param Builder $query
     * @param $price
     * @return Builder
     */
    public function scopePriceFrom(Builder $query, $price): Builder
    {
        return $query->where('price', '>=', $price);
    }

    /**
     * @param Builder $query
     * @param $price
     * @return Builder
     */
    public function scopePriceTo(Builder $query, $price): Builder
    {
        return $query->where('price', '<=', $price);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storefronts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductStorefront::class, 'product_id');
    }

    /**
     * @return MorphToMany
     */
    public function promotions(): MorphToMany
    {
        return $this->morphToMany(Promotion::class, 'promotionable');
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
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSeasons()
    {
        return $this->hasMany(ProductSeason::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productTags()
    {
        return $this->hasMany(ProductTag::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function adminProduct()
    {
        return $this->hasOne(AdminProduct::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function promotionProduct()
    {
        return $this->hasOne(PromotionProduct::class, 'product_id');
    }
}
