<?php

declare(strict_types=1);

/** @var array $lang */

/*require_once dirname( __DIR__ ) . '/vendor/autoload.php';
use \App\Controller\AuthControllerClass as AuthController;*/

$errors = AuthController::getFlash('errors');

?>

<h2 class="logo">
    <img src="<?php echo $config_component['logo_image']; ?>" alt="<?php echo $config_component['app_title']; ?>">
    <span class="d-inline-block ml-2"><?php echo $config_component['app_title']; ?></span>
</h2>

<hr>

<h1><?php echo $lang_arr['sign_up']; ?></h1>

<?php if (! empty($errors) && is_array($errors)) {
    ?>
    <div class="alert alert-danger">
        <?php echo implode('<br>', $errors); ?>
    </div>
    <?php
}
 ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">

            <form action="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=signup" method="post">
                <div class="form-group">
                    <label for="registerFormEmail"><?php echo $lang_arr['email_address']; ?>:</label>
                    <input type="email" name="email" class="form-control" id="registerFormEmail" value="<?php if (! empty($_POST['email'])) {
                        echo $_POST['email'];
                                                                                                        } ?>" required>
                </div>
                <div class="form-group">
                    <label for="registerFormPassword"><?php echo $lang_arr['password']; ?>:</label>
                    <input type="password" name="password" class="form-control" id="registerFormPassword" value="" required>
                </div>
                <div class="form-group">
                    <label for="registerFormPasswordConfirm"><?php echo $lang_arr['confirm_password']; ?>:</label>
                    <input type="password" name="password_confirm" class="form-control" id="registerFormPasswordConfirm" value="" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <?php echo $lang_arr['sign_up']; ?>
                </button>
            </form>

            <hr>
            <div class="my-3">
                <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>">
                    <?php echo $lang_arr['login']; ?>
                </a>
            </div>

        </div>
    </div>
</div>
