<x-layouts::app :title="__('Messages')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
                <flux:subheading>{{ __('Total') }}</flux:subheading>
                <flux:heading size="xl" class="mb-2">{{ count($data['messages']) + count($data['inbox']) }}</flux:heading>
                <div class="flex items-center gap-1 font-medium text-sm text-green-600 dark:text-green-400">
                    <flux:icon icon="arrow-trending-up" variant="micro" /> 10
                </div>
                <div class="absolute top-0 right-0 pr-2 pt-2">
                    <flux:button icon="envelope-open" variant="subtle" size="sm" />
                </div>
            </div>
            <div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
                <flux:subheading>{{ __('Messages') }}</flux:subheading>
                <flux:heading size="xl" class="mb-2">{{ count($data['messages']) }}</flux:heading>
                <div class="flex items-center gap-1 font-medium text-sm text-green-600 dark:text-green-400">
                    <flux:icon icon="arrow-trending-up" variant="micro" /> 10
                </div>
                <div class="absolute top-0 right-0 pr-2 pt-2">
                    <flux:button icon="envelope" variant="subtle" size="sm" />
                </div>
            </div>
            <div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
                <flux:subheading>{{ __('Inbox') }}</flux:subheading>
                <flux:heading size="xl" class="mb-2">{{ count($data['inbox']) }}</flux:heading>
                <div class="flex items-center gap-1 font-medium text-sm text-green-600 dark:text-green-400">
                    <flux:icon icon="arrow-trending-up" variant="micro" /> 10
                </div>
                <div class="absolute top-0 right-0 pr-2 pt-2">
                    <flux:button icon="inbox-arrow-down" variant="subtle" size="sm" />
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
        <livewire:toast :data="$data" />
    </div>
</x-layouts::app>