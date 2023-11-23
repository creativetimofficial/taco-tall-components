@props([
    'items' => [],
    'fullLength' => false,
])

<nav x-data="{
    items: @js($items),
}" @class([
    'w-max' => !$fullLength,
    'block w-full' => $fullLength,
])>
    <ol
        class="flex flex-wrap items-center w-full px-4 py-2 rounded-md bg-blue-gray-50 bg-opacity-60 {{ $attributes->get('class') }}">
        <template x-for="(item, index) in items">
            <li class="flex items-center font-sans text-sm antialiased font-normal leading-normal transition-colors duration-300 cursor-pointer"
                :class="index != items.length - 1 && 'opacity-60'" :disabled="index == items.length - 1">
                <a @class([
                    'text-blue-gray-900 font-medium transition-colors hover:text-blue-500',
                    $attributes->get('itemClass'),
                ]) :href="item.url != null && item.url">
                    <span x-html="item.text"></span>
                </a>
                <span x-show="index != items.length - 1"
                    class="mx-2 font-sans text-sm antialiased font-normal leading-normal pointer-events-none select-none text-blue-gray-500">
                    /
                </span>
            </li>
        </template>
    </ol>
</nav>
