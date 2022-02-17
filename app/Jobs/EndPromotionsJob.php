<?php

namespace App\Jobs;

use App\Models\Promotion;
use App\Models\PromotionProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EndPromotionsJob implements ShouldQueue
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
        $promotions = Promotion::where('to_date', '<=', now())
            ->with('promotionProduct.product')
            ->get();
        foreach ($promotions as $promotion)
        {
            foreach ($promotion->promotionProduct as $item)
            {
                $product = $item->product;
                $product->price = $product->old_price;
                $product->old_price = null;
                $product->save();
            }
        }
        PromotionProduct::whereIn('id', $promotions->pluck('promotionProduct.id'))
            ->delete();
        Promotion::whereIn('id', $promotions->pluck('id'))
            ->delete();
    }
}
