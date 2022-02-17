<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PushMessageTemplate
 * @package App\Models
 */
class PushMessageTemplate extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'push_message_templates';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'type_id',
        'changeable',
        'replaceable_keys',
    ];

    protected $casts = [
        'replaceable_keys' => 'array'
    ];

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeWhereType($query, $value)
    {
        return $query->whereHas('type', function(Builder $query) use ($value){
            $query->where('key', $value);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(PushMessageType::class, 'type_id');
    }
}
