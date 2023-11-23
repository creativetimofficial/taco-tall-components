@props([
    'id' => uniqid('alert-'),
    'color' => null,
    'textColor' => null,
    'dropMaterial' => false,
])

<div @class([
    'font-regular relative mb-4 block w-full rounded-lg p-4 text-base leading-5 opacity-100' => !$dropMaterial,
    $color ? $color : 'bg-blue-500',
    $textColor ? $textColor : 'text-white',
    $attributes->get('class'),
]) id="{{ $id }}" {{ $attributes->merge() }}>
    {{ $slot }}
</div>
