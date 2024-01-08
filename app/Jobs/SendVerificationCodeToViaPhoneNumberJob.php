<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PhoneVerificationCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class SendVerificationCodeToViaPhoneNumberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phone;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $code = new PhoneVerificationCode;
        $code->phone = $this->phone;
        $code->code = substr(str_shuffle(str_shuffle(str_shuffle('0123456789'))), 0 ,4);
        $code->save();
        $response = Http::post('https://smsmisr.com/api/SMS/?environment=1&username=3bb9d3061266dcdeb0ed8528e14f5a4fcaa3f1794d945fe7ec0ff352d7e63b2f&password=6c0022cc7648138d110bf2f3b5d1d4ab3cb74849533f0478b467762b8867603f&sender=c695658a6d17da82f4dad0897a8980058483300f7fe6982f2d79aa2cbc7ef212&mobile=+2'.$this->phone.'&language=2&message=كود التفعل الخاص لسوق التجار هو'.$code->code);
        Log::channel('sms_logs')->info($response->body());
    }
}
