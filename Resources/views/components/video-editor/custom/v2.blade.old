{{--
    https://www.w3schools.com/tags/ref_av_dom.asp
    https://stackoverflow.com/questions/34999416/jquery-event-specific-to-a-video-element
    http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4
--}}
<div class="video-container">
    <video class="video" preload="auto" width="640" height="264" {{-- poster="MY_VIDEO_POSTER.jpg" --}}
        data-setup="{}">
        <source src="{{ $mp4Src }}" type="video/mp4" />
        <source src="MY_VIDEO.webm" type="video/webm" />
        <p class="">
            To view this video please enable JavaScript, and consider upgrading to a
            web browser that
        </p>
    </video>
    <!-- Video Controls -->
    <div class="video-controls">
        <button type="button" class="play" class="play glyphicon glyphicon-play btn"></button>
        <input type="range" class="seek-bar" value="0" max="100">
        <button type="button" class="mute" class="glyphicon glyphicon-volume-up btn"></button>
        <input type="range" class="volume-bar" min="0" max="1" step="0.01" value="1">
        <button type="button" class="full-screen" class="glyphicon glyphicon-fullscreen btn"></button>
        <x-slider driver="noui" />
    </div>
</div>

@push('scripts')
    <script>
    window.onload = function() {
    $('.video-container').each(
function(idx, item) {
        var $item = $(item);

        // Video
        var video = $item.find(".video")[0];

        // Buttons
        var $playButton = $item.find(".play");
        var $muteButton = $item.find(".mute");
        var $fullScreenButton = $item.find(".full-screen");

        // Sliders
        var $seekBar = $item.find(".seek-bar");
        var $volumeBar = $item.find(".volume-bar");

        // Event listener for the play/pause button
        $playButton.click(function() {
            if (video.paused == true) {
                // Play the video
                video.play();
                // Update the button text to 'Pause'
                $playButton.removeClass("glyphicon-play").addClass("glyphicon-pause");
            } else {
                // Pause the video
                video.pause();
                // Update the button text to 'Play'
                $playButton.removeClass("glyphicon-pause").addClass("glyphicon-play");
            }
        });

        // play if video is clicked
        $(video).click(function() {
            if (video.paused == true) {
                // Play the video
                video.play();
                // Update the button text to 'Pause'
                $playButton.removeClass("glyphicon-play").addClass("glyphicon-pause");
            } else {
                // Pause the video
                video.pause();
                // Update the button text to 'Play'
                $playButton.removeClass("glyphicon-pause").addClass("glyphicon-play");
            }
        });
        // Event listener for the mute button
        $muteButton.click(function() {
            if (video.muted == false) {
                // Mute the video
                video.muted = true;
                // Update the button text
                $muteButton.removeClass("glyphicon-volume-up").addClass("glyphicon-volume-off");
            } else {
                // Unmute the video
                video.muted = false;
                // Update the button text
                $muteButton.removeClass("glyphicon-volume-off").addClass("glyphicon-volume-up");
            }
        });
        // Event listener for the full-screen button
        $fullScreenButton.click(function() {
        if (video.requestFullscreen) {
            video.requestFullscreen();
            } else if (video.mozRequestFullScreen) {
                video.mozRequestFullScreen(); // Firefox
            } else if (video.webkitRequestFullscreen) {
                video.webkitRequestFullscreen(); // Chrome and Safari
            }
        });
        // Event listener for the seek bar
        $seekBar.change(function() {
        // Calculate the new time
            var time = video.duration * ($seekBar.val() / 100);
            // Update the video time
            video.currentTime = time;
        });
        // Update the seek bar as the video plays
        video.addEventListener("timeupdate", function() {
            // Calculate the slider value
            var value = (100 / video.duration) * video.currentTime;
            // Update the slider value
            $seekBar.val(value);
        });
        // Event listener for the volume bar
        $volumeBar.change(function() {
            // Update the video volume
            video.volume = $volumeBar.val();
        });
    });
};
    </script>
@endpush

{{--
   currentSrc
theme?_act=test_video_editor&i=1:336 http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4

duration
596.474195     -- 9:56

--}}
