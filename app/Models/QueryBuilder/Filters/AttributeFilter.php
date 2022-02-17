<?php

namespace App\Models\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class AttributeFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('productOptions', function ($query) use ($property, $value) {
            $query->whereIn($property, $value);
        });
    }
}
