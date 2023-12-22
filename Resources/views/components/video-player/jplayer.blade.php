<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
    <div class="jp-type-single">
        <div class="jp-gui jp-interface">
            <div class="jp-volume-controls">
                <button class="jp-mute" role="button" tabindex="0">mute</button>
                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                </div>
            </div>
            <div class="jp-controls-holder">
                <div class="jp-controls">
                    <button class="jp-play" role="button" tabindex="0">play</button>
                    <button class="jp-stop" role="button" tabindex="0">stop</button>
                </div>
                <div class="jp-progress">
                    <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                    </div>
                </div>
                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                <div class="jp-toggles">
                    <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                </div>
            </div>
        </div>
        <div class="jp-details">
            <div class="jp-title" aria-label="title">&nbsp;</div>
        </div>
        <div class="jp-no-solution">
            <span>Update Required</span>
            To play the media you will need to either update your browser to a recent version or update your <a
                href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
        </div>
    </div>
</div>


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.min.js"
        integrity="sha512-g0etrk7svX8WYBp+ZDIqeenmkxQSXjRDTr08ie37rVFc99iXFGxmD0/SCt3kZ6sDNmr8sR0ISHkSAc/M8rQBqg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/add-on/jplayer.playlist.js"
        integrity="sha512-5mgxWEbFf/R6zCfOCkX/a2R4dRTR0xYe+hkh5g49EXdgXdJSSSjC4cI4iKhgqF93a3WC9aA53CEV4PN5XhDaAA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/add-on/jquery.jplayer.inspector.js"
        integrity="sha512-bsSCaHKldy3pgs33ghgXFLxeJRWKYoc9EMB5lfol8MG9Eh0QP9liSMeTYOFDu1g7t/ZOo7IEZct+TWRNAjY7aQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.js"
        integrity="sha512-4fFQ1hQpt0wgfD9LRVpOnPK6F9eqmZg8SXoeoj+BorFWzHJuingLRU8ZYDEH7DSwrawe95yKOzYNXbGR/5jgjA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/popcorn/popcorn.jplayer.js"
        integrity="sha512-CmWGUVWUxipQvL1O9iAU1ORjYnhihhqIr99JLYbOO6JNv2h1L68pK8DeUq2U4VWd/+RjL8lkzuzN2Knpi9fmLA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/skin/blue.monday/css/jplayer.blue.monday.css"
        integrity="sha512-hy+p5g5kWOE+l5AHCBmTo1gq1OetErrJK8u6TT2WQYUVmINNwzu9pu7oyG2f6S+qRJnbGcHu/QXpC2FV4sAvSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        $("#jquery_jplayer_1").jPlayer({
            ready: function(event) {
                $(this).jPlayer("setMedia", {
                    title: "Bubble",
                    m4a: "http://jplayer.org/audio/mp3/Miaow-07-Bubble.mp3",
                    oga: "http://jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
                });
            },
            swfPath: "http://jplayer.org/latest/dist/jplayer",
            supplied: "mp3, oga",
            wmode: "window",
            useStateClassSkin: true,
            autoBlur: false,
            smoothPlayBar: true,
            keyEnabled: true,
            remainingDuration: true,
            toggleDuration: true
        });
    </script>
@endpush
