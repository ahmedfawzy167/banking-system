<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
class WhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    public function sendWhatsAppOTP($phoneNumber, $otp)
    {
        $message = "Your OTP Code is $otp";

        try {
            $this->twilio->messages->create(
                "whatsapp:$phoneNumber", 
                [
                    'from' => config('services.twilio.whatsapp_from'),
                    'body' => $message
                ]
            );

            return ['status' => 'success', 'message' => 'OTP Sent Successfully'];
        } catch (\Exception $e) {
            Log::error('Twilio WhatsApp OTP Failed: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to send OTP'];
        }
    }
}
