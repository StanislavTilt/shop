<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

/**
 * Class Brand
 * @package App\Models
 *
 * @property string $name
 * @property string $logo
 * @property boolean $is_active
 */
class Brand extends Model
{
    use HasFactory, HasEagerLimit;

    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'logo',
        'is_active',
        'is_main'
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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
    public function scopeWhereMain($query)
    {
        return $query->where('is_main', true);
    }

    /**
     * @return MorphToMany
     */
    public function promotions(): MorphToMany
    {
        return $this->morphToMany(Promotion::class, 'promotionable');
    }
}
