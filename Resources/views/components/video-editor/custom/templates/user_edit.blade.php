<?php

declare(strict_types=1);

/* use App\Controller\BaseControllerClass; */

/** @var array $config */
/** @var array $currentUser */
/** @var array $input */
/** @var array $lang */
$errors = BaseControllerClass::getFlash('errors');
$messages = BaseControllerClass::getFlash('messages');

?>
<div class="row">
    <div class="col-md-6">

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

        <p>
            <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=users">
                &larr; <?php echo $lang_arr['back']; ?>
            </a>
        </p>

        <form action="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=edit_user&user_id=<?php echo $input['id']; ?>" method="post">
            <div class="row form-group">
                <div class="col-md-5">
                    <label for="formFieldName"><?php echo $lang_arr['name']; ?>:</label>
                </div>
                <div class="col-md-7">
                    <input class="form-control" name="name" value="<?php echo $input['name']; ?>" id="formFieldName">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-5">
                    <label for="formFieldEmail"><?php echo $lang_arr['email']; ?>:</label>
                </div>
                <div class="col-md-7">
                    <input class="form-control" name="email" value="<?php echo $input['email']; ?>" id="formFieldEmail">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-5">
                    <label for="formFieldRole"><?php echo $lang_arr['role']; ?>:</label>
                </div>
                <div class="col-md-7">
                    <input class="form-control" name="role" value="<?php echo $input['role']; ?>" id="formFieldRole">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-5">
                    <label for="formFieldType"><?php echo $lang_arr['type']; ?>:</label>
                </div>
                <div class="col-md-7">
                    <select class="form-control" name="type" id="formFieldType">
                        <option value="basic"<?php if (isset($input['type']) && 'basic' === $input['type']) {
                            ?> selected="selected"<?php
                                             } ?>>Basic</option>
                        <option value="advanced"<?php if (isset($input['type']) && 'advanced' === $input['type']) {
                            ?> selected="selected"<?php
                                                } ?>>Advanced</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-7 offset-md-5">
                    <label>
                        <input type="checkbox" name="blocked" value="1"<?php if (! empty($input['blocked'])) {
                            ?> checked<?php
                                                                       } ?>>
                        <?php echo $lang_arr['blocked']; ?>
                    </label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-7 offset-md-5">
                    <label>
                        <input type="checkbox" name="confirmed" value="1"<?php if (! empty($input['confirmed'])) {
                            ?> checked<?php
                                                                         } ?>>
                        <?php echo $lang_arr['confirmed']; ?>
                    </label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">
                        <?php echo $lang_arr['submit']; ?>
                    </button>
                </div>
            </div>
        </form>

    </div>
    <div class="col-md-6">

        <?php if (! empty($input['input_data']) && ! empty($input['input_data']['data'])) {
            ?>
        <div class="card card-primary mb-3">
            <div class="card-header card-inverse text-center"><?php echo $lang_arr['input_files']; ?></div>
            <div class="max-height300">
                <ul class="list-group list-group-flush">
                    <?php foreach ($input['input_data']['data'] as $item) {
                        ?>
                    <li class="list-group-item text-ellipsis">
                        <a href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>">
                            <span class="badge badge-warning">
                                <?php echo $item['ext']; ?>
                            </span>
                            <?php echo $item['title']; ?>
                        </a>
                    </li>
                        <?php
                    }
             ?>
                </ul>
            </div>
        </div>
<?php
        }
                             ?>

        <?php if (! empty($input['output_data']) && ! empty($input['output_data']['data'])) {
            ?>
        <div class="card card-primary">
            <div class="card-header card-inverse text-center"><?php echo $lang_arr['output_files']; ?></div>
            <div class="max-height300">
                <ul class="list-group list-group-flush">
                    <?php foreach ($input['output_data']['data'] as $item) {
                        ?>
                        <li class="list-group-item text-ellipsis">
                            <div class="float-right">
                                <?php if (empty($item['allowed'])) {
                                    ?>
                                    <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=content_status_toggle&itemId=<?php echo $item['id']; ?>&userId=<?php echo $input['id']; ?>&type=output" data-toggle="tooltip" title="Approva">
                                        <i class="icon-cross"></i>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>?action=content_status_toggle&itemId=<?php echo $item['id']; ?>&userId=<?php echo $input['id']; ?>&type=output" data-toggle="tooltip" title="Disapprova">
                                        <i class="icon-checkmark"></i>
                                    </a>
                                    <?php
                                }
                         ?>
                            </div>

                            <a href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>">
                                <span class="badge badge-warning">
                                    <?php echo $item['ext']; ?>
                                </span>
                                <?php echo $item['title']; ?>
                            </a>
                        </li>
<?php
                    }
             ?>
                </ul>
            </div>
        </div>
<?php
        }
                         ?>

    </div>
</div>
