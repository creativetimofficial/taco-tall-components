@props([
    'menu' => [],
    'button' => 'Dropdown',
    'dropMaterial' => false,
])

<div x-data="{
    isOpen: false,
    nestedMenu: null,

    openNestedMenu(index) {
        this.nestedMenu = this.nestedMenu === index ? null : index;
    },

    closeMenu() {
        this.isOpen = false;
        this.nestedMenu = null;
    },

    openMenu() {
        this.isOpen = !this.isOpen;
        this.nestedMenu = null;
    },

    openUrl(url) {
        window.open(url, '_blank');
    },

    menu: @js($menu)
}" @click.outside="closeMenu()" class="w-fit">
    <div class="relative whitespace-nowrap">
        <x-button class="{{ $attributes->get('class') }}" :dropMaterial="$dropMaterial" @click="openMenu()">
            {!! $button !!}
        </x-button>

        <template x-if="isOpen">
            <ul
                class="min-w-full absolute bg-white border border-blue-gray-50 rounded-md shadow text-blue-gray-500 font-sans text-sm font-normal max-h-96 focus:outline-none p-3 z-[99] mt-1">
                <template x-for="(item, index) in menu" :key="index">
                    <li @click="item.items ? openNestedMenu(index) : openUrl(item.url)"
                        class="relative hover:bg-blue-gray-50 focus:bg-blue-gray-50 rounded-md hover:text-blue-gray-900 focus:text-blue-gray-900 cursor-pointer leading-tight hover:bg-opacity-80 focus:bg-opacity-80 outline outline-0 pb-2 pt-[9px] px-3 select-none">
                        <span x-text="item.label"></span>
                        <ul x-show="item.items && nestedMenu === index"
                        x-transition:enter="transition duration-300"
                        x-transition:enter-start="opacity-0 translate-y-6"
                        x-transition:leave="transition translate-y-6 duration-300"
                        x-transition:leave-end="opacity-0"
                            class="min-w-full absolute bg-white border border-blue-gray-50 rounded-md shadow text-blue-gray-500 font-sans text-sm font-normal max-h-96 focus:outline-none p-3 z-[99] left-full ml-4 -top-3">
                            <template x-for="(subItem, index2) in item.items" :key="index2">
                                <li @click="openUrl(subItem.url)"
                                    class="hover:bg-blue-gray-50 focus:bg-blue-gray-50 rounded-md hover:text-blue-gray-900 focus:text-blue-gray-900 cursor-pointer leading-tight hover:bg-opacity-80 focus:bg-opacity-80 outline outline-0 pb-2 pt-[9px] px-3 select-none">
                                    <span x-text="subItem.label"></span>
                                </li>
                            </template>
                        </ul>
                    </li>
                </template>
            </ul>
        </template>
    </div>
</div>
