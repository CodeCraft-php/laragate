@php
    $wh = new ReflectionClass($webhooks[0]);
@endphp
<x-layouts::app :title="__('Webhooks')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            <div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
                <flux:subheading>{{ __('Webhooks') }}</flux:subheading>
                <flux:heading size="xl" class="mb-2">{{ count($webhooks) }}</flux:heading>
                <div class="flex items-center gap-1 font-medium text-sm text-green-600 dark:text-green-400">
                    <flux:icon icon="arrow-trending-up" variant="micro" /> 10
                </div>
                <div class="absolute top-0 right-0 pr-2 pt-2">
                    <flux:button icon="webhook" variant="subtle" size="sm" />
                </div>
            </div>
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            @if (count($webhooks) > 0)
                <livewire:webhooks.create />
                <flux:table>
                    <flux:table.columns>
                        @foreach ($wh->getProperties() as $key)
                            <flux:table.column>{{ $key->name }}</flux:table.column>
                        @endforeach
                        <flux:table.column>{{ __('Action') }}</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach ($webhooks as $webhook)
                            <flux:table.row>
                                <flux:table.cell>{{ Str::limit($webhook->ToObject()->id, 3, '***') }}</flux:table.cell>

                                <flux:table.cell>
                                    {{ $webhook->ToObject()->event }}
                                </flux:table.cell>

                                <flux:table.cell>
                                    {{ $webhook->ToObject()->url }}
                                </flux:table.cell>

                                <flux:table.cell>{{ $webhook->ToObject()->deviceId ?? ""}}</flux:table.cell>

                                <flux:table.cell>
                                    <livewire:webhooks.delete :webhookId="$webhook->ToObject()->id"
                                        :key="$webhook->ToObject()->id" />
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            @else
                <div
                    class="h-full flex items-center justify-center rounded-xl bg-white/70 p-6 text-center shadow-sm dark:bg-zinc-800/80">
                    <div class="inline-flex items-center gap-2 text-gray-500 dark:text-neutral-400">
                        <flux:icon icon="webhook" size="lg" class="text-gray-400" />
                        <span>{{ __('No webhooks found.') }}</span>
                    </div>
                    <livewire:webhooks.create />
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>