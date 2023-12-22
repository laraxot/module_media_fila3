<video src="{{ $mp4Src }}" width="320" height="240" class="mejs__player"
    data-mejsoptions='{"pluginPath": "/path/to/shims/", "alwaysShowControls": "true"}'></video>

@push('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/5.0.4/mediaelementplayer-legacy.min.css"
        integrity="sha512-vRK3gk2GsJ6Ouc3Ku0xq2HVdlDqbI1vRVPv32wak55g0N0WHuHN1LrZIRKnJKQH8DkdyFZZlZiRup0vEYVnCig=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/5.0.4/mediaelementplayer.min.css"
        integrity="sha512-uPQKP62rFWcB9WqloOcrcgA5g6DTEGm8MzM2trLIPo56C4S4IlZ9PePhDo+Bcg7xT/ntwWrn0sDSPiuVkSG7DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/5.0.4/mediaelement.min.js"
        integrity="sha512-s1KfERWE9vcMRgGHTYf5vrRZ9MdDG4bydmBHQVBf+SkJeRRzqH4DAQSqTUxn3Gi6jfqORCRVKipPCdWD7UHPfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/5.0.4/lang/it.min.js"
        integrity="sha512-j431hHloV27+DhmQ7lu1L+3x1alPKs0cvR36rXdhiA+V0IQWEytykqEUkZ4+KB5G7mTkNJadj3TaJER98gfH4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // You can use either a string for the player ID (i.e., `player`),
        // or `document.querySelector()` for any selector
        var player = new MediaElement('player', {
            pluginPath: "/path/to/shims/",
            success: function(mediaElement, originalNode) {
                // do things

            }
        });
    </script>
@endpush
