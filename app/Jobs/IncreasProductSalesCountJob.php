<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Variation;
class IncreasProductSalesCountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $variation_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($variation_id)
    {
        $this->variation_id = $variation_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $variation = Variation::find($this->variation_id);
        $product = $variation->product;
        if ($product) {
            $product->increment('sales_count');
        }
    }
}
