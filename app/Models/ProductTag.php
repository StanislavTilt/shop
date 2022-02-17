<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductTag
 * @package App\Models
 */
class ProductTag extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'product_tag';

    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'tag_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

}
