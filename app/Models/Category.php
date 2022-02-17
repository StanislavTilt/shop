<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $cover
 * @property int $order
 * @property boolean $is_active
 * @property int $parent_id
 * @property Product $products
 * @property Category $children
 */
class
Category extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'icon',
        'cover',
        'order',
        'is_active',
        'parent_id'
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWhereActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWhereRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * @return MorphToMany
     */
    public function promotions(): MorphToMany
    {
        return $this->morphToMany(Promotion::class, 'promotionable');
    }
}
