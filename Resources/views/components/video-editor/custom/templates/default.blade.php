<?php

declare(strict_types=1);

/*require_once dirname(__DIR__) . '/vendor/autoload.php';
use \App\Controller\BaseControllerClass as BaseController;*/

/* @var array $config */
/* @var array $user */
/* @var array $page_content */

?>

<h2 class="logo">
    <a href="<?php echo $config_component['base_url'].$config_component['home_url']; ?>">
        <img src="<?php echo $config_component['logo_image']; ?>" alt="<?php echo $config_component['app_title']; ?>">
        <span class="d-inline-block ml-2"><?php echo $config_component['app_title']; ?></span>
    </a>
</h2>

<hr>

<?php
if (! empty($page_content['content'])) {
    echo $page_content['content'];
}
?>
