<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    @php
        $limit = $getLimit();
        $state = \Illuminate\Support\Arr::wrap($getState());
        $limitedState = array_slice($state, 0, $limit);
        $isCircular = $isCircular();
        $isSquare = $isSquare();
        $isStacked = $isStacked();
        $overlap = $isStacked ? $getOverlap() ?? 2 : null;
        $ring = $isStacked ? $getRing() ?? 2 : null;
        $height = $getHeight() ?? ($isStacked ? '2.5rem' : '8rem');
        $width = $getWidth() ?? ($isCircular || $isSquare ? $height : null);

        $stateCount = count($state);
        $limitedStateCount = count($limitedState);

        $defaultImageUrl = $getDefaultImageUrl();

        if (!$limitedStateCount && filled($defaultImageUrl)) {
            $limitedState = [null];

            $limitedStateCount = 1;
        }

        $ringClasses = \Illuminate\Support\Arr::toCssClasses([
            'ring-white dark:ring-gray-900',
            match ($ring) {
                0 => null,
                1 => 'ring-1',
                2 => 'ring-2',
                3 => 'ring',
                4 => 'ring-4',
                default => $ring,
            },
        ]);

        $hasLimitedRemainingText = $hasLimitedRemainingText() && $limitedStateCount < $stateCount;
        $isLimitedRemainingTextSeparate = $isLimitedRemainingTextSeparate();

        $limitedRemainingTextSizeClasses = match ($getLimitedRemainingTextSize()) {
            'xs' => 'text-xs',
            'sm', null => 'text-sm',
            'base', 'md' => 'text-base',
            'lg' => 'text-lg',
            default => $size,
        };
    @endphp

    <div
        {{ $attributes->merge($getExtraAttributes(), escape: false)->class(['fi-in-image flex items-center gap-x-2.5']) }}>
        @if ($limitedStateCount)
            <div @class([
                'flex flex-wrap',
                match ($overlap) {
                    0 => null,
                    1 => '-space-x-1',
                    2 => '-space-x-2',
                    3 => '-space-x-3',
                    4 => '-space-x-4',
                    5 => '-space-x-5',
                    6 => '-space-x-6',
                    7 => '-space-x-7',
                    8 => '-space-x-8',
                    default => 'gap-1.5',
                },
            ])>

                @foreach ($limitedState as $stateItem)
                    @php
                        $src = filled($stateItem) ? $getImageUrl($stateItem) : $defaultImageUrl;

                    @endphp

                    <video
                        {{ $getExtraImgAttributeBag()->class(['max-w-none object-cover object-center', 'rounded-full' => $isCircular, $ringClasses])->style([
                                "height: {$height}" => $height,
                                "width: {$width}" => $width,
                            ]) }}
                        controls>
                        <source src="{{ $src }}" type="video/mp4">
                        {{--  
                        <source src="{{URL::asset('movie.ogg')}}" type="video/ogg"> 
                        --}}
                        Your browser does not support the video tag.
                    </video>
                @endforeach

                @if ($hasLimitedRemainingText && !$isLimitedRemainingTextSeparate && $isCircular)
                    <div style="
                            @if ($height) height: {{ $height }}; @endif
                            @if ($width) width: {{ $width }}; @endif
                        "
                        @class([
                            'flex items-center justify-center bg-gray-100 font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-400',
                            'rounded-full' => $isCircular,
                            $limitedRemainingTextSizeClasses,
                            $ringClasses,
                        ]) @style([
                            "height: {$height}" => $height,
                            "width: {$width}" => $width,
                        ])>
                        <span class="-ms-0.5">
                            +{{ $stateCount - $limitedStateCount }}
                        </span>
                    </div>
                @endif
            </div>

            @if ($hasLimitedRemainingText && ($isLimitedRemainingTextSeparate || !$isCircular))
                <div @class([
                    'font-medium text-gray-500 dark:text-gray-400',
                    $limitedRemainingTextSizeClasses,
                ])>
                    +{{ $stateCount - $limitedStateCount }}
                </div>
            @endif
        @elseif (($placeholder = $getPlaceholder()) !== null)
            <x-filament-infolists::entries.placeholder>
                {{ $placeholder }}
            </x-filament-infolists::entries.placeholder>
        @endif
    </div>
</x-dynamic-component>
