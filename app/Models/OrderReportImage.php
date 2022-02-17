<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderReportImage
 * @package App\Models
 */
class OrderReportImage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'order_report_images';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'order_report_id',
        'image',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderReport()
    {
        return $this->belongsTo(OrderReport::class, 'order_report_id');
    }
}
