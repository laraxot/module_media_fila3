<?php

declare(strict_types=1);

// dddx($lang_arr);
/*sostituiti $config con $config_component

spostato tutto l'header nel generatore del componente.

nella view non ci deve essere la logica.

/** @var array $config */
/* require_once dirname(__DIR__) . '/config/config.php'; */

/* @var array $lang */
/* le traduzioni in laravel sono in altre parti */
/*if (file_exists($config_component['root_path'] . "language/{$config_component['lang']}.php")) {
    require_once $config_component['root_path'] . "language/{$config_component['lang']}.php";
}*/

/* il debug in laravel è nell' .env */
/*if( $config_component['debug'] ){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}*/

/* la sessione viene gestita col session manager in laravel */
/* session_start(); */

/* require_once $config_component['root_path'] . 'vendor/autoload.php'; */

/* i controller non vanno qua */
/* use \App\Controller\BaseControllerClass as BaseController; */

/*$controller = new BaseController($config, $lang);
$page_content = $controller->handleRequest();

/* capire perchè da false invece di passare gli array */
/*$user = $controller->getUser(true);

$action = BaseController::getRequestAction('main');

if ($config_component['authentication']) {
    if (empty($user['id']) && !in_array($action, array('auth', 'signup', 'password_reset'))) {
        $action = 'auth';
    }
    if ($action == 'auth' && empty($user)) {
        // BaseController::redirectTo($config_component['base_url']);
    }
}*/

?>

<!--
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $config_component['base_url']; ?>assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $config_component['base_url']; ?>assets/img/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="<?php echo $config_component['base_url']; ?>favicon.ico">
-->

<?php Theme::asset('media::components.video-editor.custom/public/assets/fonts/futura-normal.ttf'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/fonts/Gotcha Gothic Light.ttf'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/fonts/Gotcha Gothic Stamp Basic.ttf'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/fonts/libel-suit-rg.ttf'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/fonts/Renogare.ttf'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/fonts/ubuntu.ttf'); ?>

<?php Theme::asset('media::components.video-editor.custom/public/assets/css/icomoon/fonts/icomoon.eot'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/css/icomoon/fonts/icomoon.ttf'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/css/icomoon/fonts/icomoon.woff'); ?>
<?php Theme::asset('media::components.video-editor.custom/public/assets/css/icomoon/fonts/icomoon.svg'); ?>

<?php Theme::add('media::components.video-editor.custom/public/lib/bootstrap/dist/css/bootstrap.css'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/jquery-ui/themes/smoothness/jquery-ui.min.css'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/nouislider/distribute/nouislider.min.css'); ?>
<?php Theme::add('media::components.video-editor.custom/public/assets/css/icomoon/style.css'); ?>
<?php Theme::add('media::components.video-editor.custom/public/assets/css/styles.css'); ?>


<div class="container">

    <div class="card">
        <div class="card-body">

            <?php
            /*echo '<pre>';
                                                                                                echo var_export('ui::components.video-editor.custom.templates.'.$action.'',true);
                                                                                                echo '</pre>';*/
            ?>

            @if (View::exists($included_view))
                @include($included_view)
            @else
                @include('media::components.video-editor.custom.templates.default')
            @endif
            <?php
/* sostituito tutto con l'include sopra */
/*if(file_exists( $config_component['root_path'] . "templates/{$action}.html.php")) {
                                                                                                                                                        include $config_component['root_path'] . "templates/{$action}.html.php";
                                                                                                                                                    } else {
                                                                                                                                                        include $config_component['root_path'] . "templates/default.html.php";
                                                                                                                                                    }*/
            ?>

        </div>
    </div>

</div>

<?php
/*echo '<pre>';
echo var_export('ui::components.video-editor.custom.templates.'.$action.'_templates',true);
echo '</pre>';*/
?>

@if (View::exists($included_template))
    @include($included_template)
@endif

<?php
/* sostituito tutto con include sopra */
/*if( file_exists( $config_component['root_path'] . "templates/{$action}_templates.html.php" ) ) {
                    include $config_component['root_path'] . "templates/{$action}_templates.html.php";
                }*/
?>

<!-- al posto di lang script mettiamo sto codice -->


<nav class="navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block active">
            <a href="/admin/theme?_act=test_video_editor&amp;i=0" class="nav-link active">custom.v1</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block ">
            <a href="/admin/theme?_act=test_video_editor&amp;i=1" class="nav-link ">custom.v2</a>
        </li>
    </ul>
</nav>

<nav class="navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block active">
            <a href="/admin/theme?_act=test_video_editor&amp;i=0" class="nav-link active">custom.v1</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block ">
            <a href="/admin/theme?_act=test_video_editor&amp;i=1" class="nav-link ">custom.v2</a>
        </li>
    </ul>
</nav>



<?php Theme::add('media::components.video-editor.custom/public/lib/jquery/dist/jquery.min.js'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/jquery-ui/jquery-ui.min.js'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/popper.js/dist/umd/popper.min.js'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/bootstrap/dist/js/bootstrap.min.js'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/underscore/underscore-min.js'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/jquery-mask-plugin/dist/jquery.mask.min.js'); ?>
<?php Theme::add('media::components.video-editor.custom/public/lib/nouislider/distribute/nouislider.js'); ?>
<?php Theme::add('media::components.video-editor.custom/public/assets/js/webvideoedit.js'); ?>


@push('scripts')
    <script>
        $(document).ready(() => {
            var LANG = {
                "signup_with_google": "Signup with Google",
                "signup_with_facebook": "Signup with Facebook",
                "email_address": "Email address",
                "password": "Password",
                "confirm_password": "Confirm password",
                "forgot_your_password": "Forgot your password?",
                "login": "Login",
                "log_out": "Log out",
                "sign_up": "Sign up",
                "need_an_account": "Need an account?",
                "reset_password": "Reset password",
                "submit": "Submit",
                "user_not_found": "User is not found.",
                "user_blocked": "User is blocked.",
                "profile": "Profile",
                "users": "Users",
                "log": "Log",
                "close": "Close",
                "import_media": "Import Media",
                "import": "import",
                "play": "Play",
                "play_small": "Play",
                "pause": "Pause",
                "play_episode": "Play episode",
                "step_back": "Step back",
                "step_forward": "Step forward",
                "take_episode": "Take episode",
                "cut_fast": "Cut fast",
                "create_video": "Create Video",
                "used": "Used",
                "youtube_url": "YouTube video URL or direct URL",
                "browse_files": "Choose file",
                "convert_video": "Convert Video",
                "convert": "Convert",
                "quality": "Quality",
                "low": "Low",
                "medium": "Medium",
                "high": "High",
                "size": "Size",
                "format": "Format",
                "name": "Name",
                "text_on_video": "Text on video",
                "text_on_full_video": "Text the whole video",
                "enter_text_here": "Enter text here",
                "static_top": "Static at the top",
                "static_bottom": "Static bottom",
                "movement_from_bottom": "Move from the bottom",
                "movement_from_left": "Move from the left",
                "aspect_ratio": "Aspect ratio",
                "choose_background_audio": "Choose a background audio file",
                "choose_audio": "Choose audio",
                "audio": "Audio",
                "create": "Create",
                "add_image_to_timeline": "Add a picture to the project",
                "preview": "Preview",
                "rename": "Rename",
                "delete": "Delete",
                "remove": "Remove",
                "edit": "Edit",
                "download": "Download",
                "empty": "Empty.",
                "yes": "Yes",
                "cancel": "Cancel",
                "confirm": "Confirm",
                "duration": "Duration",
                "text_on_image": "Text in the picture",
                "auto_split_text": "Split text into strings automatically",
                "video_preview": "Preview video",
                "image_preview": "Preview image",
                "email": "Email",
                "user_name": "Name",
                "role": "Role",
                "type": "Type",
                "social_url": "Social URL",
                "confirmed": "Confirmed",
                "blocked": "Blocked",
                "actions": "Actions",
                "admin": "Admin",
                "user": "User",
                "back": "Back",
                "input_files": "Uploaded files",
                "output_files": "Created video",
                "error": "Error",
                "please_enter_url": "Please enter the address of the file or select the media file.",
                "video_format_not_supported": "The video format is not supported in your browser.",
                "playback_not_possible": "Playback is not possible.",
                "image_parameters": "Image Options",
                "save": "Save",
                "add": "Add",
                "play_audio": "Play Audio",
                "project_is_empty": "Your project is empty.",
                "warning": "Warning",
                "processing": "Processing",
                "queue": "Queue",
                "please_wait": "Please wait...",
                "text_color": "Text color",
                "text_background_color": "Text background color",
                "white": "White",
                "black": "Black",
                "yellow": "Yellow",
                "red": "Red",
                "green": "Green",
                "blue": "Blue",
                "export_url": "Get this video",
                "import_from": "Import from ",
                "value_is_empty": "Value is empty",
                "import_from_pixabay": "Import from Pixabay",
                "import_from_google_search": "Import from Google search",
                "you_sure_you_want_remove_user": "Are you sure you want to remove user?",
                "you_sure_you_want_delete_your_account": "Are you sure you want to delete your account?",
                "your_account_activated": "Your account is activated",
                "data_successfully_saved": "The data was successfully saved.",
                "file_type_is_not_allowed": "File type is not allowed.",
                "file_size_exceeds_allowed_limit": "The file size exceeds the allowed limit.",
                "error_while_downloading_video": "Error while downloading video.",
                "error_try_later": "Error. Please try again later",
                "auth_error_try_using_different_email": "An error has occurred. Try using a different email address.",
                "you_successfully_registered": "You are successfully registered. Now you can enter.",
                "password_change_successfully_confirmed": "Password change has been successfully confirmed.",
                "wait_for_confirmation_from_administration": "Please wait for confirmation from the administration.",
                "your_new_password": "Your new password",
                "new_password_has_been_sent": "The new password has been sent to your email.",
                "passwords_do_not_match": "Passwords do not match.",
                "password_must_contain_more_than_characters": "The password must contain more than 6 characters.",
                "user_already_exists_with_email": "A user already exists with the specified email address. You can enter using your password.",
                "downloading_a_file": "Downloading a file",
                "download_file_forbidden": "You can not download this file. Has not received approval from the administration.",
                "your_account_activated_use_service": "Your account has been activated. Now you can use our service.",
                "to_confirm_click_here": "To confirm, click here",
                "audio_library": "Audio library"
            };

            var webVideoEditor = new WebVideoEditor({
                baseUrl: '<?php echo $config_component['base_url']; ?>',
                requestHandler: '<?php echo $config_component['home_url']; ?>index.php'
            });


            webVideoEditor.welcome_video('{{ $mp4Src }}');


        });
    </script>
@endpush
