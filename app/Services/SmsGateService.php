<?php

namespace App\Services;
use AndroidSmsGateway\Client;
use AndroidSmsGateway\Domain\MessageBuilder;
use AndroidSmsGateway\Domain\TokenRequest;
use AndroidSmsGateway\Domain\TokenResponse;

class SmsGateService
{
    protected Client $client;
    /**
     * Create a new class instance.
     */
    public function __construct(
        private ?string $login = null,
        private ?string $password = null,
        private ?string $url = null,
    )
    {
        $this->login    = $login    ?? config('services.sms_gateway.credentials.username');
        $this->password = $password ?? config('services.sms_gateway.credentials.password');
        $this->url      = $url      ?? config('services.sms_gateway.url');

        $this->client = new Client($this->login, $this->password, $this->url);
    }

    public function sendMessage(string $to, string $content)
    {
       $message = (new MessageBuilder($content, [$to]))
        ->setTtl(3600)                  // Message time-to-live in seconds
        ->setSimNumber(1)               // Use SIM slot 1
        ->setWithDeliveryReport(true)   // Request delivery report
        ->setPriority(100)              // Higher priority message
        ->build();

        $messageState = $this->client->SendMessage($message);
    }

    public function generateToken(string $login, string $password, array $scopes, int $ttl) : TokenResponse
    {
        // First, create a client with Basic authentication to generate a token
        $basicClient = new Client($login, $password,$this->url);

        // Create a token request with specific scopes and TTL
        $tokenRequest = new TokenRequest(
            $scopes,  // Scopes for permissions
            $ttl      // Token TTL in seconds (optional)
        );
        
        // Generate the token
        $tokenResponse = $basicClient->GenerateToken($tokenRequest);
        
        return $tokenResponse;
    }
}
