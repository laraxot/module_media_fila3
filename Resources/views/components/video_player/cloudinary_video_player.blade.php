@php
// NON HO CAPITO COME SETTARE IL MIO VIDEO
//dddx([get_defined_vars(), public_path($mp4Src)]);
@endphp

<link href="https://unpkg.com/cloudinary-video-player@1.5.9/dist/cld-video-player.min.css" rel="stylesheet">
<script src="https://unpkg.com/cloudinary-core@latest/cloudinary-core-shrinkwrap.min.js" type="text/javascript">
</script>
<script src="https://unpkg.com/cloudinary-video-player@1.5.9/dist/cld-video-player.min.js" type="text/javascript">
</script>

<video id="player" controls muted autoplay class="cld-video-player" crossorigin="anonymous" width="500">
</video>

<video id="playlist" controls muted class="cld-video-player" crossorigin="anonymous" width="500">
</video>


<script>
    var cld = cloudinary.Cloudinary.new({
        cloud_name: 'demo'
    });

    // Initialize player
    var player = cld.videoPlayer('player');


    player.source(
        'video-player/stubhub', {
            textTracks: {
                captions: {
                    label: 'English captions',
                    language: 'en',
                    default: true,
                    url: 'https://res.cloudinary.com/demo/raw/upload/v1636972013/video-player/vtt/Meetup_english.vtt'
                },
                subtitles: [{
                        label: 'German subtitles',
                        language: 'de',
                        url: 'https://res.cloudinary.com/demo/raw/upload/v1636970250/video-player/vtt/Meetup_german.vtt'
                    },
                    {
                        label: 'Russian subtitles',
                        language: 'ru',
                        url: 'https://res.cloudinary.com/demo/raw/upload/v1636970275/video-player/vtt/Meetup_russian.vtt'
                    }
                ]
            }
        }
    );

    // Playlist
    var playlist = cld.videoPlayer('playlist');

    var source1 = {
        publicId: 'video-player/stubhub',
        info: {
            title: 'Subtitles & Captions playlist'
        },
        textTracks: {
            captions: {
                label: 'English captions',
                language: 'en',
                default: true,
                url: 'https://res.cloudinary.com/demo/raw/upload/v1636972013/video-player/vtt/Meetup_english.vtt'
            },
            subtitles: [{
                    label: 'German subtitles',
                    language: 'de',
                    url: 'https://res.cloudinary.com/demo/raw/upload/v1636970250/video-player/vtt/Meetup_german.vtt'
                },
                {
                    label: 'Russian subtitles',
                    language: 'ru',
                    url: 'https://res.cloudinary.com/demo/raw/upload/v1636970275/video-player/vtt/Meetup_russian.vtt'
                }
            ]
        }
    };

    var source2 = {
        publicId: 'video-player/outdoors',
        info: {
            title: 'Outdoors',
            subtitle: 'Outdoors movie with captions'
        },
        textTracks: {
            captions: {
                label: 'English captions',
                language: 'en',
                default: true,
                url: 'https://res.cloudinary.com/demo/raw/upload/v1636971261/video-player/vtt/outdoors.vtt',
            }
        }
    };

    var source3 = {
        publicId: 'video-player/dog',
        info: {
            title: 'Dog',
            subtitle: 'Video of a dog, no captions'
        }
    };

    var playlistSources = [source1, source2, source3];

    var playlistOptions = {
        autoAdvance: true,
        repeat: true,
        presentUpcoming: 8
    };

    playlist.playlist(playlistSources, playlistOptions);
</script>
