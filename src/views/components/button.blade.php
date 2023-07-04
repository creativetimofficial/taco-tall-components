@props([
    'id' => uniqid('button-'),
    'dropMaterial' => false,
    'size' => null,
    'color' => null,
    'textColor' => null,
    'shadow' => null,
    'border' => null,
    'ring' => null,

])

<button 
    @class([
        'rounded-lg font-sans text-xs font-bold uppercase  transition-all  focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none' => !$dropMaterial,
        $size ? $size : 'py-3 px-6',
        $color ? $color : 'bg-pink-500',
        $textColor ? $textColor : 'text-white',
        $shadow ? $shadow : 'shadow-md hover:shadow-lg hover:shadow-pink-500/40 shadow-pink-500/20',
        $border,
        $ring,
        $attributes->get('class'),
    ]) 
    id="{{ $id }}"
    {{ $attributes->merge() }}
>
    {{ $slot }}
</button>