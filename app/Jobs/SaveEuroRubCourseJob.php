<?php

namespace App\Jobs;

use App\Enums\CalculatePriceCurrenciesEnum;
use App\Models\CurrencyCost;
use App\Models\OtherServerSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveEuroRubCourseJob implements ShouldQueue
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
        $vars['access_key'] = config('payment.fixer.api_key');
        $vars['symbols'] = 'USD,RUB';
        $vars['format'] = '1';
        $ch = curl_init('http://data.fixer.io/api/latest?' . http_build_query($vars));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, true);

        $eurPrice = $res['rates']['RUB'];
        $usdPrice = $res['rates']['RUB']/$res['rates']['USD'];

        CurrencyCost::whereHas('location', function (Builder $query){
            $query->where('currency_code',CalculatePriceCurrenciesEnum::EURO_CURRENCY);
        })->update(['value' => $eurPrice]);

        CurrencyCost::whereHas('location', function (Builder $query){
            $query->where('currency_code',CalculatePriceCurrenciesEnum::DOLLAR_CURRENCY);
        })->update(['value' => $usdPrice]);

    }
}
