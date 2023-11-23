<div class="relative flex flex-col w-96 text-gray-700 bg-white shadow-lg rounded-xl bg-clip-border">
    <div
        class="relative mx-4 mt-4 overflow-hidden text-white shadow-lg rounded-xl bg-blue-gray-500 bg-clip-border shadow-blue-gray-500/40 {{ $header->attributes->get('class') }}">
        {{ $header }}
    </div>
    <div class="p-6 {{ $body->attributes->get('class') }}">
        {{ $body }}
    </div>
    <div class="p-6 pt-3 {{ $footer->attributes->get('class') }}">
        {{ $footer }}
    </div>
</div>
