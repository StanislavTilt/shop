<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Color
 * @package App\Models
 */
class Color extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'colors';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'key',
        'hex',
    ];
}
