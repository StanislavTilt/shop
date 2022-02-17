<?php

namespace App\Jobs;

use App\Enums\PushMessageTemplateTypesEnum;
use App\Models\Promotion;
use App\Models\User;
use App\Services\Helpers\PromotionsServiceHelper;
use App\Services\Helpers\PushMessageHelperService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PromotionSendPushJob implements ShouldQueue
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
        $promotions = Promotion::where('from_date', '<=', now())
            ->with([ 'promotionProduct.product.brand',
                'promotionProduct.product.tags',
                'promotionProduct.product.categories.category'])
            ->get();
        $userFcmTokens = User::where('device_key', '<>', null)
            ->get()
            ->pluck('device_key')->all();
        $helperService = new PromotionsServiceHelper();
        $pushMessageHelper = new PushMessageHelperService();
        foreach ($promotions as $promotion)
        {
            $promotion = $helperService->formForPush($promotion);

            $pushMessageHelper
                ->sendPush($userFcmTokens, PushMessageTemplateTypesEnum::NEW_PROMOTION, $promotion);
        }

    }
}
