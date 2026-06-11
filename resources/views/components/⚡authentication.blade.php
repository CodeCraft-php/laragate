<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use Flux\Flux;
use Livewire\Attributes\On;
use App\Services\SmsGateService;
use App\Models\Token;

new class extends Component {
    #[Validate('required|string')]
    public string $login = 'sms'; // Default to env variable or empty string

    #[Validate('required|string')]
    public string $password = 'ae6kx5Da'; // Default to env variable or empty string

    #[Validate('required|integer')]
    public int $ttl = 36400;

    public array $selectedScopes = [];
    public string $token = '';

    #[On('scopesUpdated')]
    public function onScopesUpdated(array $scopes): void
    {
        $this->selectedScopes = $scopes;
    }

    public function generateToken(): void
    {

        try {
            $service = app(SmsGateService::class);
            $tokenResponse = $service->generateToken(
                login: $this->login,
                password: $this->password,
                scopes: $this->selectedScopes,
                ttl: $this->ttl
            );

            Token::create([
                'id' => $tokenResponse->Id(),
                'token_type' => $tokenResponse->TokenType(),
                'access_token' => $tokenResponse->AccessToken(),
                'expires_at' => now()->addSeconds($tokenResponse->ExpiresAt()),
            ]);

            Flux::toast(text: 'Token generated successfully !', variant: 'success');

        } catch (\Exception $e) {

            // Log the error for debugging
            \Log::error('Token generation failed: ' . $e->getMessage());
            Flux::toast(text: $e->getMessage(), variant: 'danger');
        }
    }
};
?>

<div>
    <form wire:submit="generateToken" class="my-6 w-full space-y-6">
        <flux:input wire:model="login" :label="__('Login')" type="text" required autofocus autocomplete="login" />

        <div>
            <flux:input wire:model="password" :label="__('Password')" type="password" required
                autocomplete="current-password" viewable />
        </div>
        <flux:subheading class="mb-6">
            {{ __('Create a token request with specific scopes and TTL(Token time-to-live in seconds (default: server dependent))') }}
        </flux:subheading>

        <livewire:scope-selector />

        <div>
            <flux:input wire:model="ttl" :label="__('TTL')" type="number" required
                autocomplete="current-ttl" />
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="update-profile-button">
                    {{ __('Generate Token') }}
                </flux:button>
            </div>

        </div>
    </form>
</div>