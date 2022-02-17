<?php

namespace App\Models\Pivot;

use App\Models\AttributeOption;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Optionable
 * @package App\Models\Pivot
 */
class Optionable extends MorphPivot
{
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'optionables';

    /**
     * @var array
     */
    protected $fillable = [
        'attribute_id',
        'attribute_option_id',
        'optionable_id',
        'optionable_type',
        'quantity',
    ];

    /**
     * @return MorphTo
     */
    public function optionable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributeOption()
    {
        return $this->belongsTo(AttributeOption::class, 'attribute_option_id');
    }
}
