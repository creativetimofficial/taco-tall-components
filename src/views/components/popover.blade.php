@props([
  'placement' => 'top',
  'text' => '',
])
 
<div x-data="{ popover: false, text:`{{ $text }}` }" class="relative w-fit" 
    @click="popover = !popover" 
    @click.outside="popover = false"
>
    {{ $slot }}
    <template x-if="popover">
            <div
                @class([
                    'absolute w-max whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none transition-opacity duration-300 opacity-1',
                    '-top-2 -translate-y-full left-1/2 -translate-x-1/2' => $placement === 'top',
                    '-bottom-2 translate-y-full left-1/2 -translate-x-1/2' => $placement === 'bottom',
                    '-left-2 translate-y-1/2 bottom-6 -translate-x-full' => $placement === 'left',
                    '-right-2 translate-y-1/2 bottom-6 translate-x-full' => $placement === 'right',
                ])
                data-placement="{{ $placement }}"
            >
                <div x-html="text"></div>
                <div
                    @class([
                        'arrow', 
                        'right-1/2 translate-x-1/2' => $placement === 'top',
                        'right-1/2 -top-1 translate-x-1/2' => $placement === 'bottom',
                        '!top-1/2' => $placement === 'left' || $placement === 'right',
                    ])
                ></div>
            </div>
    </template>
</div>