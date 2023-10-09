<?php

?>
<div class="row">
    <div class="col-md-2 order-md-10 text-right">

        <div class="dropdown d-inline-block">
            <button class="btn btn-lg btn-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="icon-menu"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" data-toggle="action" data-action="profile">
                    <span class="icon-user-tie"></span>
                    <?php
echo 'lingua profile';
?>
                </a>
                <?php
if ('utente role' === 'admin') { ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo 'config base_urlconfig home_url'; ?>?action=users">
                    <span class="icon-users"></span>
                    <?php echo 'lingua users'; ?>
                </a>
                <?php }
?>
                <?php
?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="action" data-action="log">
                    <span class="icon-file-text"></span>
                    <?php
echo 'lingua log';
?>
                </a>
                <?php
?>
                <?php
?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php
echo 'config base_urlconfig home_url';
?>index.php?action=logout">
                    <span class="icon-exit"></span>
                    <?php
echo 'lingua log_out';
?>
                </a>
                <?php
?>
            </div>
        </div>

    </div>
    <div class="col-md-6 order-md-2 text-sm-left text-center">
        <h2 class="logo">
            <img src="<?php
echo 'config logo_image';
?>" alt="<?php
echo 'config app_title';
?>">
            <span class="d-inline-block ml-2"><?php
echo 'config app_title';
?></span>
        </h2>
    </div>
    <div class="col-md-4 order-md-2">
        <div id="wve-user-stat">
            <div class="progress mt-3">
                <div class="progress-bar <?php
if (0 >= 85) { ?>bg-danger<?php } else { ?>bg-success<?php }
?>"
                    role="progressbar" style="width: <?php
echo 'opzioni utente files_size_percent';
?>%" aria-valuenow="<?php
echo 'opzioni utente files_size_percent';
?>"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text-center small mb-3">
                <?php
echo 'lingua used';
?>:
                <?php
echo 'opzioni utente files_size_percent';
?>%
                &mdash;
                <?php
echo 'opzioni utente files_size_total';
?>
                /
                <?php
echo 'opzioni utente files_size_max';
?>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-4 order-md-last">

        <div class="form-group">
            <button type="button" class="btn btn-lg btn-smp btn-outline-primary btn-block" data-toggle="action"
                data-action="import">
                <span class="icon-download"></span>
                <?php
echo 'lingua import_media';
?>
            </button>
        </div>

        <div class="mb-3 border rounded-0" style="max-height: 338px; overflow: auto;">
            <ul class="list-group" id="wve-list_input">

            </ul>
        </div>

    </div>
    <div class="col-md-8 order-md-first">

        <div class="card mb-3">
            <div class="card-body">

                <div class="wve-editor-player">
                    <video src="" preload="auto" width="400" height="360" class="d-block"
                        id="wve-video"></video>
                    <div class="wve-editor-player-panel" style="display: none;">
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
                            <input type="text" class="form-control form-control-sm wve-time-input-out"
                                value="">
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
                        data-action="stepback_main" title="<?php
echo 'lingua step_back';
?>">
                        <span class="icon-arrow-left2"></span>
                    </button>
                    <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                        data-action="play_main" title="<?php
echo 'lingua play';
?>">
                        <span class="icon-play3"></span>
                    </button>
                    <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                        data-action="stepforward_main" title="<?php
echo 'lingua step_forward';
?>">
                        <span class="icon-arrow-right2"></span>
                    </button>
                    <button type="button" class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                        data-action="play_selected" title="<?php
echo 'lingua play_episode';
?>">
                        <span class="icon-play2"></span>
                    </button>
                </div>
            </div>

            <div class="clearfix hidden-md-up"></div>

            <div class="col-lg-2 col-sm-6">

                <div class="my-2">
                    <div class="btn-group btn-group-justified btn-group-lg margin-bottom-md" role="group">
                        <button class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                            data-action="take-episode" title="<?php
echo 'lingua take_episode';
?>">
                            <span class="icon-plus"></span>
                        </button>
                        <button class="btn btn-outline-primary toggle-tooltip" data-toggle="action"
                            data-action="cut-fast" title="<?php
echo 'lingua cut_fast';
?>">
                            <span class="icon-scissors"></span>
                        </button>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-sm-6">

                <div class="my-2">
                    <button type="button" class="btn btn-block btn-lg btn-smp btn-outline-primary"
                        data-toggle="action" data-action="render">
                        <span class="icon-checkmark"></span>
                        <?php
echo 'lingua create_video';
?>
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

{{-- per aggiungere javascript e css come files --}}
{{-- per le immagini è theme assets --}}
{{-- per script e css inline è @push('scripts') e @push('styles') --}}
{{ Theme::add('ui::components.video_editor.css.icomoon/style.css') }}
{{ Theme::add('ui::components.video_editor.css/styles.css') }}
{{ Theme::add('ui::components.video_editor.js/webvideoedit.js') }}

@push('scripts')
    <script>
        let webVideoEditor = new WebVideoEditor({

        });
    </script>
@endpush
<?php
