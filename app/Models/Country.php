<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @package App\Models
 */
class Country extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $table = 'countries';

    /**
     * @var array
     */
    protected $fillable = [
        'location_id',
        'name',
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
