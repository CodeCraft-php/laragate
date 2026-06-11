<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use Flux\Flux;
use App\Services\Webhooks\WebhookService;

new class extends Component {
    #[Validate('required|string')]
    public string $url = ''; //

    #[Validate('required|string')]
    public string $event = ''; //

    public function registerWebhook(): void
    {
        try{
            app(WebhookService::class)->registerWebhook('https://'.$this->url,$this->event);
            
            Flux::modal('register-webhook')->close();
            Flux::toast(text: 'Webhook registered !', variant: 'success');
        }catch(\Exception $e){
            Flux::modal('register-webhook')->close();
            Log::channel('laragate')->error('Register Webhook failed: ' . $e->getMessage());
            Flux::toast(text: 'Failed !', variant: 'danger');
        }
    }
};
?>

<div>
    <flux:modal.trigger name="register-webhook">
        <flux:button>Register Webhook</flux:button>
    </flux:modal.trigger>
    <flux:modal name="register-webhook" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Register Webhook</flux:heading>
                <flux:text class="mt-2">Enter the details for your new webhook.</flux:text>
            </div>

            <flux:input.group :label="__('URL')">
                <flux:input.group.prefix>https://</flux:input.group.prefix>

                <flux:input wire:model="url" placeholder="example.com" />
            </flux:input.group>

            <flux:select wire:model="event" label="Event Type" placeholder="Select an event...">

                <flux:select.option disabled>── SMS Incoming ──</flux:select.option>
                <flux:select.option value="sms:received">📩 SMS Received</flux:select.option>
                <flux:select.option value="sms:data-received" disabled>📦 SMS Data Received — Coming Soon</flux:select.option>
                <flux:select.option value="mms:received" disabled>🖼️ MMS Received — Coming Soon</flux:select.option>

                <flux:select.option disabled>── SMS Outgoing ──</flux:select.option>
                <flux:select.option value="sms:sent">📤 SMS Sent</flux:select.option>
                <flux:select.option value="sms:delivered">✅ SMS Delivered</flux:select.option>
                <flux:select.option value="sms:failed">❌ SMS Failed</flux:select.option>

                <flux:select.option disabled>── System ──</flux:select.option>
                <flux:select.option value="system:ping">🏓 System Ping</flux:select.option>

            </flux:select>

            <div class="flex">
                <flux:spacer />
                <flux:button wire:click="registerWebhook" variant="primary">Register Webhook</flux:button>
            </div>
        </div>
    </flux:modal>
</div>