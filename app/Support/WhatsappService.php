<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected ?string $apiUrl;

    protected ?string $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.whatsapp.api_url');
        $this->apiKey = config('services.whatsapp.api_key');
    }

    public function sendOtp(string $phone, string $message): bool
    {
        if (! $this->apiUrl || ! $this->apiKey) {
            Log::warning('WhatsApp service is not configured — skipping OTP send.');

            return false;
        }

        // Stored as 01XXXXXXXXX → WhatsApp expects 201XXXXXXXXX
        $chatId = '20'.ltrim($phone, '0').'@c.us';

        $payload = [
            'chatId' => $chatId,
            'reply_to' => null,
            'text' => $message,
            'linkPreview' => true,
            'linkPreviewHighQuality' => false,
            'session' => 'default',
        ];

        try {
            $response = Http::timeout(10)
                ->withHeaders(['X-Api-Key' => $this->apiKey])
                ->withoutVerifying()
                ->post($this->apiUrl, $payload);

            $response->throw();

            return true;
        } catch (\Illuminate\Http\Client\RequestException $e) {
            Log::error("WhatsApp HTTP request failed for {$phone}: ".$e->getMessage());
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("WhatsApp connection failed for {$phone}: ".$e->getMessage());
        } catch (\Exception $e) {
            Log::error("WhatsApp failed to send OTP to {$phone}: ".$e->getMessage());
        }

        return false;
    }
}
