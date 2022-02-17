<?php


namespace App\Models\QueryBuilder\Includes;
use Spatie\QueryBuilder\Includes\IncludeInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LimitInclude
 * @package App\Models\QueryBuilder\Includes
 */
class LimitInclude implements IncludeInterface
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * LimitInclude constructor.
     * @param int $limit
     */
    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @param Builder $query
     * @param string $relations
     */
    public function __invoke(Builder $query, string $relations)
    {
        $query->with($relations, function ($query) {
            $query->latest()->limit($this->limit);
        });
    }
}
