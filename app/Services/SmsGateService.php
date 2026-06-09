<?php

namespace App\Services;
use AndroidSmsGateway\Client;
use AndroidSmsGateway\Domain\MessageBuilder;

class SmsGateService
{
    private Client $client;
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
        // try {
            
        //     echo "✅ Message sent! ID: " . $messageState->ID() . PHP_EOL;
            
            
        //     // Check status after delay
        //     // sleep(5);
        //     // $updatedState = $this->client->GetMessageState($messageState->ID());
        //     // echo "📊 Message status: " . $updatedState->State() . PHP_EOL;

        // } catch (\Exception $e) {
        //     echo "❌ Error: " . $e->getMessage() . PHP_EOL;
        //     exit(1);
        // }
    }
}
