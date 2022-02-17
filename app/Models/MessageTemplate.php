<?php

namespace App\Models;

use App\Enums\MessageTemplateKeysEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageTemplate
 * @package App\Models
 */
class MessageTemplate extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'message_templates';

    /**
     * @var bool
     */
    public $timestamps  = true;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'key',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWhereKey($query, $value)
    {
        return $query->where('key', $value);
    }

}
