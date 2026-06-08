@php
    $data = array_map(function($message) {
        return [
            'id' => Str::limit($message['id'],3,'***'),
            'content' =>  Str::limit($message['contentPreview'],25,'...'),
            'sender' => $message['sender'],
            'created_at' => \Carbon\Carbon::parse($message['createdAt'])->format('d/m/Y H:i:s'),
            'sim_number' => $message['simNumber'],
            'type' => $message['type'],
        ];
    }, $data);
@endphp
<x-layouts::app :title="__('Incoming Messages')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
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
        </div>
    </div>
</x-layouts::app>