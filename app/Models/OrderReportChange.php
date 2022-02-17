<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderReportChange
 * @package App\Models
 */
class OrderReportChange extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'order_report_changes';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'order_report_id',
        'admin_id',
        'new_status',
        'new_comment',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function report()
    {
        return $this->belongsTo(OrderReport::class, 'order_report_id');
    }
}
