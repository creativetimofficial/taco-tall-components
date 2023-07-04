@props([
    'name' => ''
])

@error($name)
    <p
        @class([
            $attributes->get('class')
        ]) 
        {{ $attributes->merge() }}
    >
        {{ $message }}
    </p>
@enderror