<?php

namespace App\Jobs;

use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSeason;
use App\Models\ProductStorefront;
use App\Models\ProductTag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RemoveArchivedProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $products = Product::where('removal_time', '<=' , now())
            ->get();
        ProductCategory::whereIn('product_id', $products->pluck('id'))
            ->delete();
        ProductSeason::whereIn('product_id', $products->pluck('id'))
            ->delete();
        OrderProduct::whereIn('product_id', $products->pluck('id'))
            ->delete();
        ProductStorefront::whereIn('product_id', $products->pluck('id'))
            ->delete();
        ProductTag::whereIn('product_id', $products->pluck('id'))
            ->delete();
        Product::whereIn('id', $products->pluck('id'))
            ->delete();
    }
}
