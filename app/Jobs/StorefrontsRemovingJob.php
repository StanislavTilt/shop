<?php

namespace App\Jobs;

use App\Models\OtherServerSetting;
use App\Models\Product;
use App\Models\ProductStorefront;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StorefrontsRemovingJob implements ShouldQueue
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
        ProductStorefront::where('expired_at', '<=' , now())
            ->delete();
        $days = OtherServerSetting::getSettingValue(OtherServerSetting::ARCHIVE_REMOVAL_DAYS);
        Product::doesnthave('storefronts')->update(['status' => 0,'removal_time' => now()->addDays($days)]);
    }
}
