<span class="media-library-button media-library-button-{{ $attributes['level'] ?? 'info' }}" {{ $attributes->except(['icon','level']) }}>
    <x-media.icon :icon="$attributes['icon']" />
</span>
