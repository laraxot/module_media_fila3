@php
/*
//Theme::add('media::assets/video-editor/custom/v1/js/app.min.js');
Theme::add('media::assets/video-editor/custom/v1/css/styles.css');
Theme::add('media::assets/lib/nouislider/distribute/nouislider.min.css');
Theme::add('media::assets/video-editor/custom/v1/css/icomoon/style.css');
Theme::add('media::assets/lib/jquery-mask-plugin/dist/jquery.mask.min.js');
Theme::add('media::assets/lib/nouislider/distribute/nouislider.min.js');
Theme::add('media::assets/video-editor/custom/v1/css/styles.css');
Theme::add('media::assets/video-editor/custom/v1/js/webvideoedit.js');
*/

Theme::add('media::assets/lib/bootstrap/dist/css/bootstrap.css');
Theme::add('media::assets/lib/jquery-ui/themes/smoothness/jquery-ui.min.css');
Theme::add('media::assets/lib/nouislider/distribute/nouislider.min.css');
Theme::add('media::assets/video-editor/custom/v1/css/icomoon/style.css');
Theme::add('media::assets/video-editor/custom/v1/css/styles.css');

Theme::add('media::assets/lib/jquery/dist/jquery.min.js');
Theme::add('media::assets/lib/jquery-ui/jquery-ui.min.js');
Theme::add('media::assets/lib/popper.js/dist/umd/popper.min.js');
Theme::add('media::assets/lib/bootstrap/dist/js/bootstrap.min.js');
Theme::add('media::assets/lib/underscore/underscore-min.js');
Theme::add('media::assets/lib/jquery-mask-plugin/dist/jquery.mask.min.js');
Theme::add('media::assets/lib/nouislider/distribute/nouislider.min.js');
Theme::add('media::assets/video-editor/custom/v1/js/webvideoedit.js');

@endphp

@push('scripts')
    <script>
        let webVideoEditor = new WebVideoEditor({
            baseUrl: '/',
            requestHandler: 'index.php'
        });
    </script>
@endpush

<div class="row">
    <div class="col-md-12 order-md-first">

        <div class="card mb-3">
            <div class="card-body">

                <div class="wve-editor-player">
                    <video src="{{ $mp4Src }}" preload="auto" width="400" height="360" class="d-block"
                        id="wve-video"></video>
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
                                <i class="icon-cross"></i>
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
                    <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                        data-action="stepback_main" title="step_back">
                        <span class="icon-arrow-left2"></span>
                    </button>
                    <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                        data-action="play_main" title="play">
                        <span class="icon-play3"></span>
                    </button>
                    <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                        data-action="stepforward_main" title="step_forward">
                        <span class="icon-arrow-right2"></span>
                    </button>
                    <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                        data-action="play_selected" title="play_episode">
                        <span class="icon-play2"></span>
                    </button>
                </div>
            </div>

            <div class="clearfix hidden-md-up"></div>

            <div class="col-lg-2 col-sm-6">

                <div class="my-2">
                    <div class="btn-group btn-group-justified btn-group-lg margin-bottom-md" role="group">
                        <button class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                            data-action="take-episode" title="take_episode">
                            <span class="icon-plus"></span>
                        </button>
                        <button class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                            data-action="cut-fast" title="cut_fast">
                            <span class="icon-scissors"></span>
                        </button>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-sm-6">

                <div class="my-2">
                    <button type="button" class="btn btn-block btn-lg btn-smp btn-outline-primary" data-toggle="action"
                        data-action="render">
                        <span class="icon-checkmark"></span>
                        create_video
                    </button>
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
