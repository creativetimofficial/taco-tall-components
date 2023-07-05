@props([
    'show' => false,
])

<div
    x-data="{
        isOpen: '{{ $show }}',
        show: function($bool) {
            this.isOpen = $bool
            @this.set('show', this.isOpen)
        }
    }"
    @keyup.escape.window="isOpen = false"
    class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center"
    :class="isOpen ? 'bg-black bg-opacity-60 backdrop-blur-sm' : 'pointer-events-none'"
    x-cloak
>
    <div
        x-show="isOpen"
        @click.away="show(false)"
        x-transition:enter="transition-opacity duration-300"
        class="relative rounded-lg bg-white font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased shadow-2xl {{ $attributes->get('class') }}"
    >
        <div class="flex shrink-0 items-center p-4 font-sans text-2xl font-semibold leading-snug text-blue-gray-900 antialiased {{ $header->attributes->get('class') }}">
            {{ $header }}
        </div>
        <div class="relative border-t border-b border-t-blue-gray-100 border-b-blue-gray-100 p-4 font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased {{ $body->attributes->get('class') }}">
            {{ $body }}
        </div>
        <div class="flex shrink-0 flex-wrap items-center justify-end p-4 text-blue-gray-500 {{ $footer->attributes->get('class') }}">
            {{ $footer }}
        </div>
    </div>
</div>