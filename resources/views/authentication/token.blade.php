<x-layouts::app :title="__('Token')">
    <div class="flex items-start max-md:flex-col">
        <section class="w-full">
            <div class="relative mb-6 w-full">
                <flux:heading size="xl" level="1">{{ __('JWT Token') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('JWT Token uses bearer tokens for authentication.') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>

            <flux:heading class="sr-only">{{ __('Using a JWT Token') }}</flux:heading>

            <x-authentication-layout :heading="__('JWT Token')">
              <livewire:token-revoke />
            </x-authentication-layout>
        </section>
    </div>
</x-layouts::app>