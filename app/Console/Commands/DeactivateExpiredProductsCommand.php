<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeactivateExpiredProductsCommand extends Command
{
    protected $signature = 'product:deactivate-expired';

    protected $description = 'Deactivates expired products';

    public function handle()
    {
        Product::whereRaw("DATEDIFF(CURDATE(), created_at) >= 7")
            ->update([
            'status' => Product::STATUS_DEACTIVE
        ]);
    }
}
