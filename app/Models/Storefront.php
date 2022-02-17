<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Storefront
 * @package App\Models
 *
 * @property string $title
 * @property string $cover
 * @property string $key
 * @property array $parameters
 */
class Storefront extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'key',
        'parameters',
        'cover',
        'changeable',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'parameters' => 'array',
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('expired_at');
    }
}
