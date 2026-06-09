@php
    $data = array_map(function ($message) {
        return [
            'id' => Str::limit($message['id'], 3, '***'),
            'content' => Str::limit($message['contentPreview'], 25, '...'),
            'sender' => $message['sender'],
            'date' => \Carbon\Carbon::parse($message['createdAt'])->format('d/m/Y H:i:s'),
            'sim' => $message['simNumber'],
            'type' => $message['type'],
        ];
    }, $data);
@endphp
<x-layouts::app :title="__('Incoming Messages')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            {{-- <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div> --}}
            <div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
                <flux:subheading>{{ __('Inbox') }}</flux:subheading>
                <flux:heading size="xl" class="mb-2">{{ count($data) }}</flux:heading>
                <div class="flex items-center gap-1 font-medium text-sm text-green-600 dark:text-green-400">
                    <flux:icon icon="arrow-trending-up" variant="micro" /> 10
                </div>
                <div class="absolute top-0 right-0 pr-2 pt-2">
                    <flux:button icon="inbox-arrow-down" variant="subtle" size="sm" />
                </div>
            </div>
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            @if (count($data) > 0)
                <flux:table>
                    <flux:table.columns>
                        @foreach (array_keys($data[0]) as $key)
                            <flux:table.column>{{ $key }}</flux:table.column>
                        @endforeach
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach ($data as $message)
                            <flux:table.row>
                                @foreach ($message as $value)
                                    <flux:table.cell>{{ $value }}</flux:table.cell>
                                @endforeach
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            @else
                <div class="h-full flex items-center justify-center rounded-xl bg-white/70 p-6 text-center shadow-sm dark:bg-zinc-800/80">
                    <div class="inline-flex items-center gap-2 text-gray-500 dark:text-neutral-400">
                        <flux:icon icon="envelope" size="lg" class="text-gray-400" />
                        <span>{{ __('No incoming messages found.') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>