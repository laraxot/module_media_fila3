<?php

declare(strict_types=1);

/** @var array $lang */

/*require_once dirname( __DIR__ ) . '/vendor/autoload.php';
use \App\Controller\AuthControllerClass as AuthController;*/

$errors = AuthController::getFlash('errors');
$messages = AuthController::getFlash('messages');

?>

<h2 class="logo">
    <img src="<?php echo $config_component['logo_image']; ?>" alt="<?php echo $config_component['app_title']; ?>">
    <span class="d-inline-block ml-2"><?php echo $config_component['app_title']; ?></span>
</h2>

<hr>

<p>
    <?php echo $config_component['app_description']; ?>
</p>

<?php if (! empty($config_component['facebook_app_id']) || ! empty($config_component['google_client_id'])) {
    ?>
    <hr>
    <div>
        <a class="btn btn-primary my-2" href="<?php echo AuthController::getGoogleAuthUrl(); ?>">
            <i class="icon-google"></i>
            &nbsp;
            <?php echo $lang_arr['signup_with_google']; ?>
        </a>
        <a class="btn btn-primary my-2" href="<?php echo AuthController::getFacebookAuthUrl($config_component['facebook_app_id']); ?>">
            <i class="icon-facebook2"></i>
            &nbsp;
            <?php echo $lang_arr['signup_with_facebook']; ?>
        </a>
    </div>
    <?php
}
 ?>

<?php if (! empty($errors) && is_array($errors)) {
    ?>
    <div class="alert alert-danger my-2">
        <?php echo implode('<br>', $errors); ?>
    </div>
    <?php
}
     ?>

<?php if (! empty($messages) && is_array($messages)) {
    ?>
    <div class="alert alert-info my-2">
        <?php echo implode('<br>', $messages); ?>
    </div>
    <?php
}
     ?>

<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">

            <form action="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=auth" method="post">
                <div class="form-group">
                    <label for="loginFormEmail"><?php echo $lang_arr['email_address']; ?>:</label>
                    <input type="email" name="email" class="form-control" id="loginFormEmail" value="<?php if (! empty($_POST['email'])) {
                        echo $_POST['email'];
                                                                                                     } ?>" required>
                </div>
                <div class="form-group">
                    <label for="loginFormPassword"><?php echo $lang_arr['password']; ?>:</label>
                    <input type="password" name="password" class="form-control" id="loginFormPassword" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <?php echo $lang_arr['login']; ?>
                </button>
                &nbsp;
                <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=password_reset">
                    <?php echo $lang_arr['forgot_your_password']; ?>
                </a>
            </form>

            <hr>
            <div class="my-3">
                <?php echo $lang_arr['need_an_account']; ?>
                <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=signup">
                    <?php echo $lang_arr['sign_up']; ?>
                </a>
            </div>

        </div>
    </div>
</div>
