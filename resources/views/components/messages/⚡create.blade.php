<?php

use Livewire\Component;
use Flux\Flux;
use App\Services\SmsGateService;

new class extends Component {
    public string $dialCode = '+237';
    public string $phone = '';
    public string $message = '';

    public function sendMessage(): void
    {
        $this->validate([
            'message' => 'required|string',
            'dialCode' => 'required',
            'phone' => 'required',
        ]);
        // ton appel API ici
        app(SmsGateService::class)->sendMessage($this->dialCode . $this->phone, $this->message);

        Flux::modal('send-message')->close();
        Flux::toast(text: 'Message envoyé !', variant: 'success');
    }
};
?>

<div>
    <flux:modal.trigger name="send-message">
        <flux:button>Send message</flux:button>
    </flux:modal.trigger>
    <flux:modal name="send-message" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Send message</flux:heading>
                <flux:text class="mt-2">Enter the details for your outgoing message.</flux:text>
            </div>

            <flux:input label="Message" placeholder="Your message text here." wire:model="message" />

            <flux:input.group>
                <flux:select class="max-w-fit" wire:model="dialCode">
                    <flux:select.option value="+237" selected>🇨🇲 +237</flux:select.option>
                    <flux:select.option value="+33">🇫🇷 +33</flux:select.option>
                    <flux:select.option value="+1">🇺🇸 +1</flux:select.option>
                    <flux:select.option value="+44">🇬🇧 +44</flux:select.option>
                    <flux:select.option value="+221">🇸🇳 +221</flux:select.option>
                    <flux:select.option value="+225">🇨🇮 +225</flux:select.option>
                </flux:select>
                <flux:input type="tel" placeholder="6 00 00 00 00" wire:model="phone" />
            </flux:input.group>

            <div class="flex">
                <flux:spacer />
                <flux:button wire:click="sendMessage" variant="primary">Send message</flux:button>
            </div>
        </div>
    </flux:modal>
</div>