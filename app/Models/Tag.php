<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App\Models
 *
 * @property string $name
 * @property string $key
 * @property string $value
 * @property int $order
 */
class Tag extends Model
{
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'key',
        'order'
    ];

    public function productTag()
    {
        return $this->hasMany(ProductTag::class,'tag_id');
    }
}
