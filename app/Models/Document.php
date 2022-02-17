<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\Models
 *
 * @param int $id
 * @param string $title
 * @param string $content
 * @param string $slug
 */
class Document extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'content',
        'slug'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
