<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Promotionable
 * @package App\Models
 */
class Promotionable extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'promotionables';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'promotion_id',
        'promotionable_id',
        'promotionable_type',
    ];
}
