<?php

namespace App\Models;

use App\Models\Pivot\Optionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PhpOption\Option;

/**
 * Class Attribute
 * @package App\Models
 *
 * @property string $name
 * @property string $type
 * @property string $key
 * @property int $sort_order
 * @property Product $products
 * @property AttributeOption $options
 * @property boolean $is_required
 */
class Attribute extends Model
{
    const TYPE_SELECT = 'select';
    const TYPE_MULTISELECT = 'multiselect';
    const TYPE_TEXT = 'text';
    const TYPE_CHECKBOX = 'checkbox';

    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'key',
        'sort_order',
        'is_required'
    ];

    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(AttributeOption::class);
    }
}
