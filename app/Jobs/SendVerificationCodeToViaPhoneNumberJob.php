<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PhoneVerificationCode;
use Illuminate\Routing\Redirector;
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
     * @return Application|RedirectResponse|Redirector|void
     */
    public function handle()
    {
        $code = substr(str_shuffle(str_shuffle(str_shuffle('0123456789'))), 0, 4);
        try {
            $check = PhoneVerificationCode::where([
                ['phone', '=', $this->phone]
            ])->first();
            if ($check) {
                return redirect(route('verify_phone.index'))->with('error', __('messages.already_send_code'));
            }
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'])
                ->post('http://api.yamamah.com/SendSMS', [
                    "Username" => "0569111000",
                    "Password" => "D3DEeP2uezZyrix",
                    "Tagname" => "ARTEE",
                    "RecepientNumber" => $this->phone,
                    "VariableList" => "",
                    "ReplacementList" => "",
                    "Message" => __('messages.send_code', ['code' => $code]),
                    "SendDateTime" => 0,
                    "EnableDR" => False
                ]);
            PhoneVerificationCode::create([
                'phone' => $this->phone,
                'code' => $code,
            ]);
            Log::channel('sms_logs')->info($response->body());
        } catch (\Throwable $exception) {
            Log::channel('sms_logs')->info($exception->getMessage());
            return redirect(route('verify_phone.index'))->with('error', __('messages.invalid_code'));
        }
    }
}
