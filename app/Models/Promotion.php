<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Promotion
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $percent
 * @property Carbon $from_date
 * @property Carbon $to_date
 * @property int $status
 * @property Brand $brands
 * @property Product $products
 * @property Category $categories
 */
class Promotion extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'percent',
        'from_date',
        'to_date',
        'is_active',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'from_date' => 'datetime',
        'to_date' => 'datetime',
    ];

    /**
     * @return MorphToMany
     */
    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'promotionable');
    }

    /**
     * @return MorphToMany
     */
    public function brands(): MorphToMany
    {
        return $this->morphedByMany(Brand::class, 'promotionable');
    }

    /**
     * @return MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'promotionable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotionProduct()
    {
        return $this->hasMany(PromotionProduct::class, 'promotion_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWhereActive($query)
    {
        return $query->where('is_active', true);
    }
}
