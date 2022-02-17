<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BadWord
 * @package App\Models
 */
class BadWord extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'bad_words';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'bad_word',
        'replace_word',
    ];
}
