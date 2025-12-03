<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected $baseUrl;
    protected $instanceId;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://app.hypersender.com/api/whatsapp/v1';
        $this->instanceId = config('services.hypersender.instance_id');
        $this->apiKey = config('services.hypersender.api_key');
    }

    public function sendWhatsAppOTP($phoneNumber, $otp)
{
    $message = "Your OTP Code is: $otp";

    try {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/{$this->instanceId}/send-text", [
            'chatId' => "{$phoneNumber}@s.whatsapp.net", 
            'text' => $message,
            'link_preview' => false,
        ]);

        $responseData = $response->json();

        if ($response->successful() && isset($responseData['status']) && $responseData['status'] == 'success') {
            return ['status' => 'success', 'message' => 'OTP Sent Successfully'];
        }

    } catch (\Exception $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}

   
}
