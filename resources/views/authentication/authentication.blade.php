<x-layouts::app :title="__('Authentication')">
    <div class="flex items-start max-md:flex-col">
        <section class="w-full">
            <div class="relative mb-6 w-full">
                <flux:heading size="xl" level="1">{{ __('JWT Authentication') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('JWT authentication uses bearer tokens for authentication.') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>

            <flux:heading class="sr-only">{{ __('Generating a JWT Token') }}</flux:heading>

            <x-authentication-layout :heading="__('JWT Token')" :subheading="__('First, create a client with Basic authentication to generate a token')">
                <livewire:authentication />
            </x-authentication-layout>
        </section>
    </div>
</x-layouts::app>