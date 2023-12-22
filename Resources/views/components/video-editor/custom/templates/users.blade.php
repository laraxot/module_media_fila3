<?php

declare(strict_types=1);

/*require_once dirname( __DIR__ ) . '/vendor/autoload.php';
use \App\Controller\UsersControllerClass as UsersController;*/

/* @var array $config */
/** @var array $user */
/* @var array $page_content */
/* @var array $lang */

if (empty($user) || 'admin' !== $user['role']) {
    UsersController::redirectTo($config_component['base_url'].$config_component['home_url']);
}

?>
<h2 class="logo">
    <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>">
        <img src="<?php echo $config_component['logo_image']; ?>" alt="<?php echo $config_component['app_title']; ?>">
        <span class="d-inline-block ml-2"><?php echo $config_component['app_title']; ?></span>
    </a>
</h2>

<hr>

<h1>
    <?php echo $lang_arr['users']; ?>
</h1>

<?php if (! empty($page_content['data'])) {
    ?>
    <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo $lang_arr['name']; ?></th>
                <th><?php echo $lang_arr['social_url']; ?></th>
                <th><?php echo $lang_arr['email']; ?></th>
                <th><?php echo $lang_arr['role']; ?></th>
                <th><?php echo $lang_arr['type']; ?></th>
                <th><?php echo $lang_arr['confirmed']; ?></th>
                <th><?php echo $lang_arr['actions']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($page_content['data'] as $index => $user) {
                ?>
            <tr>
                <th scope="row">
                    <?php echo $page_content['pages']['offset'] + $index + 1; ?>
                </th>
                <td>
                    <?php echo $user['name']; ?>
                </td>
                <td class="no-wrap">
                    <?php if (! empty($user['facebook_id'])) {
                        ?>
                        <a href="https://www.facebook.com/app_scoped_user_id/<?php echo $user['facebook_id']; ?>/" target="_blank">
                            <i class="icon-facebook"></i>
                            <?php echo $user['facebook_id']; ?>
                        </a>
                        <?php
                    } elseif (! empty($user['google_id'])) {
                        ?>
                        <a href="https://profiles.google.com/<?php echo $user['google_id']; ?>" target="_blank">
                            <i class="icon-google"></i>
                            <?php echo $user['google_id']; ?>
                        </a>
                        <?php
                    }
                 ?>
                </td>
                <td>
                    <?php echo $user['email']; ?>
                </td>
                <td>
                    <?php if (! empty($user['blocked'])) {
                        ?>
                        <div class="badge badge-default big">Blocked</div>
                        <?php
                    } elseif ('admin' === $user['role']) {
                        ?>
                        <div class="badge badge-warning badge-pill">
                            <?php echo $lang_arr['admin']; ?>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="badge badge-default badge-pill">
                            <?php echo $lang_arr['user']; ?>
                        </div>
                        <?php
                    }
                         ?>
                </td>
                <td>
                    <?php
                    if (
                        'admin' !== $user['role']
                            && ! empty($user['type'])
                    ) {
                        echo ucfirst((string) $user['type']);
                    }
                    ?>
                </td>
                <td class="text-center">
                    <?php if (! empty($user['confirmed'])) {
                        ?>
                        <i class="icon-checkmark"></i>
                        <?php
                    } else {
                        ?>
                        <i class="icon-cross"></i>
                        <?php
                    }
                     ?>
                </td>
                <td class="text-right no-wrap">
                    <a class="btn btn-secondary btn-sm" href="<?php echo $config_component['base_url'].$config_component['home_url'].'?action=edit_user&user_id='.urlencode((string) $user['id']); ?>">
                        <?php echo $lang_arr['edit']; ?>
                    </a>
                    <a class="btn btn-danger btn-sm" href="<?php echo $config_component['base_url'].$config_component['home_url'].'?action=delete_user&user_id='.urlencode((string) $user['id']); ?>">
                        <?php echo $lang_arr['delete']; ?>
                    </a>
                </td>
            </tr>
<?php
            }
     ?>
        </tbody>
    </table>
    </div>

    <?php include __DIR__.'/pagination.html.php'; ?>

<?php
} ?>
