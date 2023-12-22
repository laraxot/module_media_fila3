@extends('adm_theme::layouts.app')
@section('content')
    <x-navbar>
        @foreach ($players as $k => $v)
            <x-navbar.item href="{!! Request::fullUrlWithQuery(['i' => $k]) !!}" active="{{ $player == $v ? 'active' : '' }}">
                {{ $v }}
            </x-navbar.item>
        @endforeach
    </x-navbar>

    @if ($player!=null)
    <x-col size="3">
        {{--
        <x-video-player :player="$player" :mp4Src="$mp4_src" currentTime="0"></x-video-player>
        --}}
        {{ $mp4_src }}
        <v-videoplayer src="{{ $mp4_src }}" currentTime="0" id="videoplayer1"></v-videoplayer>
    </x-col>
    @endif
@endsection
