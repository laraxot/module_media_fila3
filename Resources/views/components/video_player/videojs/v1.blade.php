{{--
@push('styles')
<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
@endpush
--}}

<video controls preload="auto" data-setup='{ "fluid":true }' class="video-js vjs-big-play-centered">
    <source src="{{ $mp4Src }}" type="video/mp4" />
</video>

{{--
<source src="https://hls.protone.media/redfield.m3u8" type="application/x-mpegUrl">
--}}
