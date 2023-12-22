@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/flowplayer/dist/flowplayer.min.js') }}"></script>
@endpush
@push('styles')
    <!-- player styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/flowplayer/dist/skin/skin.css') }}">
@endpush
<!-- player 1 -->
<div class="flowplayer">
    <video src="{{ $mp4Src }}"></video>
</div>
