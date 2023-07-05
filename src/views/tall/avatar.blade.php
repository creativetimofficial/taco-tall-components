@props([
    'dropMaterial' => false,
    'size' => null,
])

<img
    @class([
        'relative rounded-lg inline-block object-cover object-center' => !$dropMaterial,
        $size ? $size : 'h-6 w-6',
        $attributes->get('class'),
    ])
    {{ $attributes->merge() }}
/>