@props([
  'placement' => 'top',
  'text' => ''
])
 
<div x-data="{ tooltip: false }" class="relative w-fit" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
    {{ $slot }}
  <template x-if="tooltip">
         <div
            @class([
                'absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none transition-opacity duration-300 pointer-events-none opacity-1 min-w-max',
                '-top-2 -translate-y-full left-1/2 -translate-x-1/2' => $placement === 'top',
                '-bottom-2 translate-y-full left-1/2 -translate-x-1/2' => $placement === 'bottom',
                '-left-1 -bottom-1/2 -translate-y-full -translate-x-full' => $placement === 'left',
                '-right-1 -bottom-1/2 -translate-y-full translate-x-full' => $placement === 'right',
              ])
            data-show
        >
          {!! $text !!}
          <div
            @class([
                'right-1/2 translate-x-1/2' => $placement === 'top',
                'right-1/2 -top-1 translate-x-1/2' => $placement === 'bottom',
                '-right-1 bottom-2.5' => $placement === 'left',
                '-left-1 bottom-2.5' => $placement === 'right',
              ])
          ></div>
        </div>
  </template>
</div>


