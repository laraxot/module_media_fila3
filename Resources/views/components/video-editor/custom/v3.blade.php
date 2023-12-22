<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 order-md-last">

            </div>
            <div class="col-md-8 order-md-first">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="wve-editor-player">
                            <video src="{{ $mp4Src }}" preload="auto" width="400" height="360"
                                class="d-block" id="wve-video"></video>
                            <div class="wve-editor-player-panel" {{-- style="display: none;" --}}>
                                <div class="time" id="wve-editor-player-time"></div>
                                <div class="time time-current" id="wve-editor-player-time-current"></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Timeline slider -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="editor-timeline-wrapper">
                    <div id="wve-timeline"></div>
                    <div id="wve-timeline-range"></div>
                    <div id="wve-time-selected-inputs">
                        <div class="card card-body py-2 px-4 shadow-1 bg-secondary">
                            <div class="row">
                                <div class="col-5 pl-1 pr-1">
                                    <input type="text" class="form-control form-control-sm wve-time-input-in" value="">
                                </div>
                                <div class="col-5 pl-1 pr-1">
                                    <input type="text" class="form-control form-control-sm wve-time-input-out" value="">
                                </div>
                                <div class="col-2 pl-1 pr-1">
                                    <button type="button" class="btn btn-outline-light btn-block text-center p-1">
                                        {{-- <i class="icon-cross"></i> --}}
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <hr>
                <!-- buttons -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="btn-group btn-group-justified btn-group-lg my-2" role="group">
                            {{-- <button type="button" class="btn btn-outline-primary toggle-tooltip"
                                data-toggle="action" data-action="stepback_main" title="Step back">
                                <span class="icon-arrow-left2"></span>
                            </button> --}}
                            <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                                data-action="play_main" title="Play">
                                {{-- <span class="icon-play3"></span> --}}
                                <i class="fas fa-play"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-outline-primary toggle-tooltip"
                                data-toggle="action" data-action="stepforward_main" title="Step forward">
                                <span class="icon-arrow-right2"></span>
                            </button> --}}
                            <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                                data-action="play_selected" title="Play episode">
                                {{-- <span class="icon-play2"></span> --}}
                                <i class="far fa-play-circle"></i>

                            </button>

                            <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                                data-action="" title="Take Photo">

                                <i class="fas fa-camera"></i>

                            </button>
                        </div>
                    </div>

                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-lg-2 col-sm-6">

                        <div class="my-2">
                            <div class="btn-group btn-group-justified btn-group-lg margin-bottom-md" role="group">
                                <button class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                                    data-action="take-episode" title="Take episode">
                                    {{-- <span class="icon-plus"></span> --}}
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                                    data-action="cut-fast" title="Cut fast">
                                    {{-- <span class="icon-scissors"></span> --}}
                                    <i class="fas fa-cut"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-sm-6">

                        <div class="my-2">
                            <button type="button" class="btn btn-block btn-lg btn-smp btn-outline-primary"
                                data-toggle="action" data-action="render">
                                {{-- <span class="icon-checkmark"></span> --}}
                                <i class="fas fa-check"></i>
                                Create Video </button>
                        </div>

                    </div>

                </div>
                <!-- /buttons -->

                <!-- episode-container -->
                <div class="episode-container" id="wve-episode-container" style="display: none;">
                    <hr class="mb-0">
                    <div class="row wve-episode-container" id="wve-episode-container-inner"></div>
                    <div class="clearfix"></div>
                </div>
                <!-- /episode-container -->

            </div>
        </div>
        <!-- /Timeline slider -->

        <!-- Output list -->
        <div class="card">
            <div class="card-body">
                <div class="bottom-list-container border rounded-0">
                    <table class="table table-bordered table-hover no-margin">
                        <colgroup>
                            <col width="40%">
                            <col width="20%">
                            <col width="15%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        <tbody id="wve-list_output"></tbody>
                    </table>

                </div>

            </div>
        </div>
        <!-- /Output list -->

    </div>
</div>

@php

//Theme::add('media::assets/css/icomoon/style.css');
Theme::add('media::assets/css/styles.css');

Theme::add('media::assets/lib/jquery-mask-plugin/dist/jquery.mask.min.js');
Theme::add('media::assets/js/webvideoedit_xot.js');
@endphp

@push('scripts')

    <script>
        var webVideoEditor = new WebVideoEditor({
            baseUrl: '/',
            requestHandler: 'index.php',
            currentMedia: {
                ext: 'mp4',
                title: 'intro',
                duration_ms: 6000,
                duration_time: '00:06:00',
                type: 'video',
                isIntro: true,
                url: '/videos/test.mp4'
            }
        });
    </script>
@endpush
