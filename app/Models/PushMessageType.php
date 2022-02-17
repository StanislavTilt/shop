<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PushMessageType
 * @package App\Models
 */
class PushMessageType extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'push_message_types';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function messageTemplate()
    {
        return $this->hasOne(PushMessageTemplate::class, 'type_id');
    }

}
