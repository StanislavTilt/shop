<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PhoneChangeRequest
 * @package App\Models
 */
class PhoneChangeRequest extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'phone_change_requests';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'new_phone',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
