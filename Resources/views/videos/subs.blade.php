@foreach ($subs as $sk => $sub)
    <span class="subitem" data-id="{{ $sub->id }}" data-pos="{{ $sk }}" data-start="{{ $sub->start }}"
        data-end="{{ $sub->end }}">{{ $sub['text'] }}</span>
@endforeach
