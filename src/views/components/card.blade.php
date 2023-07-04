@switch($attributes->get('type'))
    @case('simple')
        <div class="flex flex-col bg-white rounded-xl bg-clip-border shadow-card">
            <div class="flex-1 p-6 text-secondary">
                <div class="{{ $header->attributes->get('class') }}">
                    {{ $header }}
                </div>
                <div class="{{ $body->attributes->get('class') }}">
                    {{ $body }}
                </div>
                <div class="{{ $footer->attributes->get('class') }}">
                    {{ $footer }}
                </div>
            </div>
        </div>
    @break

    @case('image')
        <div class="flex flex-col bg-white rounded-xl bg-clip-border shadow-card">
            <div class="translate-y-0 mx-4 mt-4 {{ $header->attributes->get('class') }}">
                {{ $header }}
            </div>
            <div class="text-secondary flex-1 p-6 {{ $body->attributes->get('class') }}">
                {{ $body }}
            </div>
            <div class="bg-transparent p-6 pt-0 {{ $footer->attributes->get('class') }}">
                {{ $footer }}
            </div>
        </div>
    @break

    @case('signin')
        <div class="flex flex-col bg-white rounded-xl bg-clip-border shadow-card">
            <div class="mx-4 -mt-6 translate-y-0">
                <div class="shadow-pink pe-1 rounded-lg bg-pink-500 py-3 {{ $header->attributes->get('class') }}">
                    {{ $header }}
                </div>
            </div>
            <div class="flex-1 p-6 text-secondary">
                <div class="{{ $body->attributes->get('class') }}">
                    {{ $body }}
                </div>
                <div class="{{ $footer->attributes->get('class') }}">
                    {{ $footer }}
                </div>
            </div>
        </div>
    @break

    @case('horizontal')
        <div class="flex flex-col bg-transparent bg-white shadow-none rounded-xl bg-clip-border">
            <div class="flex">
                <div class="w-1/3 {{ $header->attributes->get('class') }}">
                    {{ $header }}
                </div>
                <div class="flex-1 w-2/3 p-6 text-secondary">
                    <div class="{{ $body->attributes->get('class') }}">
                        {{ $body }}
                    </div>
                    <p class="{{ $footer->attributes->get('class') }}">
                        {{ $footer }}
                    </p>
                </div>
            </div>
        </div>
    @break

    @case('horizontalRight')
        <div class="flex flex-col bg-transparent bg-white shadow-none rounded-xl bg-clip-border">
            <div class="flex">
                <div class="flex-1 w-auto p-6 text-secondary">
                    <div class="{{ $body->attributes->get('class') }}">
                        {{ $body }}
                    </div>
                    <p class="{{ $footer->attributes->get('class') }}">
                        {{ $footer }}
                    </p>
                </div>
                <div class="w-1/3 {{ $header->attributes->get('class') }}">
                    {{ $header }}
                </div>
            </div>
        </div>
    @break

    @case('pricing')
        <div
            class="relative flex flex-col w-full p-8 text-white shadow-md rounded-xl bg-gradient-to-tr from-pink-600 to-pink-400 bg-clip-border shadow-pink-500/40">
            <div
                class="relative m-0 mb-8 overflow-hidden rounded-none border-b border-white/10 bg-transparent bg-clip-border pb-8 text-center text-gray-700 shadow-none {{ $header->attributes->get('class') }}">
                {{ $header }}
            </div>
            <div class="p-0">
                <ul class="flex flex-col gap-4 {{ $body->attributes->get('class') }}">
                    {{ $body }}
                </ul>
            </div>
            <div class="mt-12 p-0 {{ $footer->attributes->get('class') }}">
                {{ $footer }}
            </div>
        </div>
    @break

    @case('blog')
        <div class="relative flex flex-col overflow-hidden text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div
                class="relative m-0 overflow-hidden rounded-none bg-transparent bg-clip-border text-gray-700 shadow-none {{ $header->attributes->get('class') }}">
                {{ $header }}
            </div>
            <div class="p-6 {{ $body->attributes->get('class') }}">
                {{ $body }}
            </div>
            <div class="flex items-center justify-between p-6 {{ $footer->attributes->get('class') }}">
                {{ $footer }}
            </div>
        </div>
    @break

    @case('backgroundBlog')
        <div
            class="relative grid h-[40rem] w-full flex-col items-end justify-center overflow-hidden rounded-xl bg-white bg-clip-border text-center text-gray-700">
            <div class="{{ $header->attributes->get('class') }}">
                {{ $header }}
                <div class="relative p-6 px-6 py-14 md:px-12">
                    <div class="{{ $body->attributes->get('class') }}">
                        {{ $body }}
                    </div>
                    <div class="{{ $footer->attributes->get('class') }}">
                        {{ $footer }}
                    </div>
                </div>
            </div>
        </div>
    @break

    @case('booking')
        <div class="relative flex flex-col w-full text-gray-700 bg-white shadow-lg rounded-xl bg-clip-border">
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
    @break

    @case('testimonial')
        <div class="relative flex flex-col w-full text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
            <div
                class="relative flex items-center gap-4 pt-0 pb-8 mx-0 mt-4 overflow-hidden text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border {{ $header->attributes->get('class') }}">
                {{ $header }}
            </div>
            <div class="mb-6 p-0 {{ $body->attributes->get('class') }}">
                {{ $body }}
            </div>
        </div>
    @break

    @default
        <div class="flex flex-col bg-white rounded-xl bg-clip-border shadow-card">
            <div class="translate-y-0 mx-4 -mt-6 {{ $header->attributes->get('class') }}">
                {{ $header }}
            </div>
            <div class="flex-1 p-6 text-secondary">
                <div class="{{ $body->attributes->get('class') }}">
                    {{ $body }}
                </div>
                <div class="{{ $footer->attributes->get('class') }}">
                    {{ $footer }}
                </div>
            </div>
        </div>
@endswitch
