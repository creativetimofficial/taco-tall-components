@props([
    'id' => uniqid('typography-'),
    'color' => null,
    'dropMaterial' => false,
])
@switch($attributes->get('as'))
    @case('h1')
        <h1 @class([
            'block font-sans antialiased text-5xl font-semibold leading-tight tracking-normal' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</h1>
    @break

    @case('h2')
        <h2 @class([
            'block font-sans antialiased text-4xl font-semibold leading-[1.3] tracking-normal' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</h2>
    @break

    @case('h3')
        <h3 @class([
            'block font-sans antialiased text-3xl font-semibold leading-snug tracking-normal' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</h3>
    @break

    @case('h4')
        <h4 @class([
            'block font-sans antialiased text-2xl font-semibold leading-snug tracking-normal' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</h4>
    @break

    @case('h5')
        <h5 @class([
            'block font-sans antialiased text-xl font-semibold leading-snug tracking-normal' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</h5>
    @break

    @case('h6')
        <h6 @class([
            'block font-sans antialiased text-base font-semibold leading-relaxed capitalize tracking-normal' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</h6>
    @break

    @case('lead')
        <p @class([
            'block font-sans antialiased text-xl font-normal leading-relaxed' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</p>
    @break

    @case('small')
        <small @class([
            'block font-sans antialiased text-base font-light leading-relaxed' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</small>
    @break

    @default
        <p @class([
            'block font-sans antialiased text-sm font-light leading-normal' => !$dropMaterial,
            $color ? $color : 'text-black',
            $attributes->get('class'),
        ]) id="{{ $id }}" {{ $attributes->merge() }}>{{ $slot }}</p>
@endswitch
