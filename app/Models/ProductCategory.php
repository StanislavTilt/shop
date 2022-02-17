<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * @package App\Models
 */
class ProductCategory extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'category_product';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'category_id',
        'product_id',
    ];
}
