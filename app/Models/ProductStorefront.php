<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductStorefront
 * @package App\Models
 */
class ProductStorefront extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'product_storefront';

    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'storefront_id',
        'expired_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storefront()
    {
        return $this->belongsTo(Storefront::class);
    }
}
