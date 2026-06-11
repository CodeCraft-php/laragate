<?php

namespace App\Services\Webhooks;

use App\Services\SmsGateService;
use AndroidSmsGateway\Domain\Webhook;
use AndroidSmsGateway\Enums\WebhookEvent;

class WebhookService extends SmsGateService
{
   
    public function listWebhooks()
    {
        $response = $this->client->ListWebhooks();
        return $response;
    }

    public function registerWebhook(string $url, string $events)
    {
        $event = match ($events) {
            "sms:received" => $events = WebhookEvent::SMS_RECEIVED(),
            "sms:sent" => $events = WebhookEvent::SMS_SENT(),
            "sms:delivered" => $events = WebhookEvent::SMS_DELIVERED(),
            "sms:failed" => $events = WebhookEvent::SMS_FAILED(),
            "system:ping" => $events = WebhookEvent::SYSTEM_PING(),
            default => throw new \InvalidArgumentException('Invalid event type'),
        };

        $webhook = new Webhook($event, $url);

        $this->client->RegisterWebhook($webhook);
    }

    public function deleteWebhook(string $webhookId){
        $this->client->DeleteWebhook($webhookId);
    }
}
