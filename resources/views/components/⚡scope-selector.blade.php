<?php

use Livewire\Component;

new class extends Component {
    public array $selected = [];

    public array $scopes = [
        'Messages' => [
            ['value' => 'messages:send', 'label' => 'Send Messages', 'description' => 'Permission to send SMS messages', 'access' => 'Write'],
            ['value' => 'messages:read', 'label' => 'Read Messages', 'description' => 'Permission to read message details', 'access' => 'Read'],
            ['value' => 'messages:list', 'label' => 'List Messages', 'description' => 'Permission to list and view messages', 'access' => 'Read'],
        ],
        'Devices' => [
            ['value' => 'devices:list', 'label' => 'List Devices', 'description' => 'Permission to list registered devices', 'access' => 'Read'],
            ['value' => 'devices:delete', 'label' => 'Delete Devices', 'description' => 'Permission to remove devices', 'access' => 'Delete'],
        ],
        'Webhooks' => [
            ['value' => 'webhooks:list', 'label' => 'List Webhooks', 'description' => 'Permission to list webhook configurations', 'access' => 'Read'],
            ['value' => 'webhooks:write', 'label' => 'Write Webhooks', 'description' => 'Permission to create/modify webhooks', 'access' => 'Write'],
            ['value' => 'webhooks:delete', 'label' => 'Delete Webhooks', 'description' => 'Permission to remove webhooks', 'access' => 'Delete'],
        ],
        'Settings' => [
            ['value' => 'settings:read', 'label' => 'Read Settings', 'description' => 'Permission to read settings', 'access' => 'Read'],
            ['value' => 'settings:write', 'label' => 'Write Settings', 'description' => 'Permission to modify settings', 'access' => 'Write'],
        ],
        'Logs' => [
            ['value' => 'logs:read', 'label' => 'Read Logs', 'description' => 'Permission to read logs', 'access' => 'Read'],
        ],
        'Tokens' => [
            ['value' => 'tokens:manage', 'label' => 'Manage Tokens', 'description' => 'Permission to generate/revoke tokens', 'access' => 'Administrative'],
            ['value' => 'tokens:refresh', 'label' => 'Refresh Tokens', 'description' => 'System scope for token refresh', 'access' => 'System'],
        ],
    ];
    public function updatedSelected(): void
    {
        $this->dispatch('scopesUpdated', scopes: $this->selected);
    }
};
?>
<div>
    @php
        $accessColors = [
            'Full Access' => 'lime',
            'Read' => 'blue',
            'Write' => 'yellow',
            'Delete' => 'red',
            'Administrative' => 'purple',
            'System' => 'zinc',
        ];
    @endphp

    <div>
        <div class="space-y-4 mt-4">
            @foreach ($scopes as $group => $permissions)
                <div class="space-y-2">

                    {{-- Un groupe isolé par section --}}
                    <flux:checkbox.group wire:model.live="selected">

                        <div data-scope-all>
                            <flux:checkbox.all label="{{ $group }}" />
                        </div>

                        <div class="ml-6 space-y-1">
                            @foreach ($permissions as $permission)
                                <div class="flex items-center justify-between">
                                    <flux:checkbox value="{{ $permission['value'] }}" label="{{ $permission['label'] }}"
                                        description="{{ $permission['description'] }}" />
                                    <flux:badge size="sm" color="{{ $accessColors[$permission['access']] ?? 'zinc' }}">
                                        {{ $permission['access'] }}
                                    </flux:badge>
                                </div>
                            @endforeach
                        </div>

                    </flux:checkbox.group>

                </div>

                @if (!$loop->last)
                    <flux:separator />
                @endif
            @endforeach
        </div>
    </div>
</div>