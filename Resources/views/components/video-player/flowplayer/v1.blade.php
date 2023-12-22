@push('styles')
    <style>
        .flowplayer {
            background-color: #324584;
            max-width: 1000px
        }

    </style>
@endpush

@push('scripts')
    <script src="//cdn.flowplayer.com/players/8dfd6c14-ba3a-445e-8ef5-191d9358ed0a/native/flowplayer.async.js">
        {
            "src": "8fdb4e20-8ebb-4590-8844-dae39680d837",
            "plugins": ["thumbnails"],
            "thumbnails": {
                "src": "https://stdlwcdn.lwcdn.com/i/8fdb4e20-8ebb-4590-8844-dae39680d837/160p.vtt"
            }

        }
    </script>
@endpush


<div class="use-play-1 flowplayer" data-player-id="56058953-2cbd-4858-a915-1253bf7ef7b2">

</div>
