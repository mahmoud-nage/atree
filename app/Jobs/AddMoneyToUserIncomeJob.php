<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Income;
use App\Models\OrderItem;
use App\Models\Settings;
use Carbon\Carbon;
class AddMoneyToUserIncomeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $item;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->item->load('variation.product' , 'order');
        $settings = Settings::first();
        if ($this->item) {
            $user_income = new Income;
            $user_income->amount = $this->item->calculateMarketerMoney();
            $user_income->user_id = $this->item->order?->user_id;
            $user_income->order_id = $this->item->order?->id;
            $user_income->product_id = $this->item?->variation?->product_id;
            $user_income->withdrawn = 0;
            $user_income->can_withdrawal_when = Carbon::now()->addHours($settings->days_to_valid_marketer_money);
            $user_income->save();
        }
    }
}
