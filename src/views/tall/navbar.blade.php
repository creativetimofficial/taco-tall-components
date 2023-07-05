@props([
'items' => [],
])

<nav x-data="{
        isOpen: false,
    }"
    class="block w-full max-w-screen-xl px-4 py-2 mx-auto text-white bg-white border shadow-md rounded-xl border-white/80 bg-opacity-80 backdrop-blur-2xl backdrop-saturate-200 lg:px-8 lg:py-4 {{$attributes->get('class')}}"
    >
    <div>
        <div class="container flex items-center justify-between mx-auto text-gray-900">
            <div class="{{ $title->attributes->get('class') }}">
                {{ $title }}
            </div>

            <ul class="items-center hidden gap-6 lg:flex {{ $items->attributes->get('class') }}">
                {{ $items }}
            </ul>

            <div class="hidden lg:inline-block {{ $buttons->attributes->get('class') }}">
                {{ $buttons }}
            </div>

            <button @click="isOpen = !isOpen"
                class="relative ml-auto h-6 max-h-[40px] w-6 max-w-[40px] rounded-lg text-center font-sans text-xs font-medium uppercase text-blue-gray-500 transition-all hover:bg-transparent focus:bg-transparent active:bg-transparent disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:hidden"
                data-collapse-target="navbar">
                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                        strokeWidth="2">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </span>
            </button>
        </div>
        <div class="block w-full overflow-hidden transition-all duration-300 ease-in basis-full lg:hidden"
            :class="!isOpen && 'h-0'"
            data-collapse="navbar">
            <div class="container mx-auto">
                <ul class="flex flex-col gap-2 mt-2 mb-4 {{ $items->attributes->get('class') }}">
                    {{ $items }}
                </ul>
                <div class="lg:hidden {{ $buttons->attributes->get('class') }}">
                    {{ $buttons }}
                </div>
            </div>
        </div>
    </div>
</nav>
