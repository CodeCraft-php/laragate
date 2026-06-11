<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Services\Webhooks\WebhookService;
use Flux\Flux;

new class extends Component
{
    #[Validate('required|string')]
    public string $webhookId = "";

    public function mount(string $webhookId): void
    {
        $this->webhookId = $webhookId;
    }

    public function deleteWebhook(){
        try{
            app(WebhookService::class)->deleteWebhook($this->webhookId);

            Flux::toast(text: 'Webhook deleted !', variant: 'success');
        }catch(\Exception $e){
            Log::channel('laragate')->error('Delete Webhook failed: ' . $e->getMessage());
            Flux::toast(text: 'Failed !', variant: 'danger');
        }
    }
};
?>

<div>
    <flux:button wire:click="deleteWebhook" variant="danger">Delete</flux:button>
</div>