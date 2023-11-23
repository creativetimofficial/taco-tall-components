@props([
    'showPercentageLabel' => false,
    'dropMaterial' => false,
    'percentage' => 0,
    'color' => null,
    'textColor' => null,
])

<div @class([
    'w-full' => !$dropMaterial,
])>
    <div @class([
        'flex-start flex w-full overflow-hidden rounded-sm bg-blue-gray-50 font-sans text-xs font-medium' => !$dropMaterial,
        'h-4' => filter_var($showPercentageLabel, FILTER_VALIDATE_BOOLEAN),
        'h-1.5' => !filter_var($showPercentageLabel, FILTER_VALIDATE_BOOLEAN),
    ])>
        <div @class([
            'flex h-full items-baseline justify-center overflow-hidden break-all' => !$dropMaterial,
            $color ? $color : 'bg-blue-500',
            $textColor ? $textColor : 'text-white',
            $attributes->get('class'),
        ]) style="width: {{ $percentage }}%">
            @if (filter_var($showPercentageLabel, FILTER_VALIDATE_BOOLEAN))
                <span>{{ $percentage }}% Completed</span>
            @endif
        </div>
    </div>
</div>
