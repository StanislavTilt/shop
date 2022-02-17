<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 * @package App\Models
 */
class Vendor extends Model
{
    use HasFactory;

    public $timestamps = false;

    /*
     *
     * @var string
     */
    protected $table = 'vendors';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }
}
