<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Season
 * @package App\Models
 */
class Season extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'seasons';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seasonProducts()
    {
        return $this->hasMany(ProductSeason::class, 'season_id');
    }
}
