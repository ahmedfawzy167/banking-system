<?php

namespace App\Services;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SmsService
{
    private Client $client;

    public function __construct()
    {
        $basic = new Basic(config('services.vonage.api_key'), config('services.vonage.api_secret'));
        $this->client = new Client($basic);
    }

    public function sendSms(string $to, string $message): void
    {
        $this->client->sms()->send(
            new SMS($to, config('services.vonage.sms_from'), $message)
        );
    }
}
