@props([
    'dropMaterial' => false,
    'color' => null,
    'textColor' => null,
])

<div
    @class([
        'relative inline-block select-none whitespace-nowrap rounded-lg py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none' => !$dropMaterial,
        $color ? $color : 'bg-black',
        $textColor ? $textColor : 'text-white',
        $attributes->get('class'),
    ])     
    
    {{ $attributes->merge() }}
    > 
        {{ $slot }} 
</div>