@extends('adm_theme::layouts.app')
@section('content')
    <livewire:media.crud name="upload" :model="$_panel->getParent()->row" collection="media" />
@endsection
{{ Theme::add('media::css/media.css') }}
