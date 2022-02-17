<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ValidationRequest
 * @package App\Models
 */
class ValidationRequest extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'validation_requests';

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
        'additional_parameters',
        'expired_at',
        'key',
        'method',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'additional_parameters' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
