@php $attributes = $unescapedForwardedAttributes ?? $attributes; @endphp
@props(['variant' => 'outline'])
@php
$classes = Flux::classes('shrink-0')
    ->add(match($variant) {
        'outline' => '[:where(&)]:size-6',
        'solid'   => '[:where(&)]:size-6',
        'mini'    => '[:where(&)]:size-5',
        'micro'   => '[:where(&)]:size-4',
    });
@endphp

<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true"
     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
     stroke-width="1.5" stroke="currentColor">
  <!-- Enveloppe -->
  <path stroke-linecap="round" stroke-linejoin="round"
    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
  <!-- Flèche vers le haut (sortant) -->
  <path stroke-linecap="round" stroke-linejoin="round"
    d="M12 16.5v-6m0 0-2 2m2-2 2 2" />
</svg>