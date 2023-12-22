<nav aria-label="pagination">
    <?php if (! empty($page_content['pages']) && $page_content['pages']['total'] > 1) { ?>
    <ul class="pagination">
        <?php if (1 === $page_content['pages']['current']) { ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">&laquo;</a>
            </li>
        <?php } else { ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $config_component['base_url'].$config_component['home_url'].'?action=users&page='.($page_content['pages']['current'] - 1); ?>">
                    &laquo;
                </a>
            </li>
        <?php }
 ?>

        <?php
            $skipped = false;
        for ($i = 0; $i < $page_content['pages']['total']; ++$i) {
            if (
                ($i > 2 && $i < $page_content['pages']['total'] - 2)
                && ($i < $page_content['pages']['current'] - 3 || $i > $page_content['pages']['current'] + 3)
            ) {
                $skipped = true;
                continue;
            }
             ?>
            <?php if ($skipped) {
                $skipped = false; ?>
                <li class="page-item disabled">
                    <a class="page-link">...</a>
                </li>
                <?php
            }
             ?>
            <li class="page-item<?php if ($page_content['pages']['current'] === $i + 1) {
                ?> active<?php
                                } ?>">
                <a class="page-link" href="<?php echo $config_component['base_url'].$config_component['home_url'].'?action=users&page='.($i + 1); ?>">
                    <?php echo $i + 1; ?>
                </a>
            </li>
<?php
        }
         ?>

        <?php if ($page_content['pages']['current'] === $page_content['pages']['total']) { ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">&raquo;</a>
            </li>
        <?php } else { ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $config_component['base_url'].$config_component['home_url'].'?action=users&page='.($page_content['pages']['current'] + 1); ?>">
                    &raquo;
                </a>
            </li>
        <?php }
                 ?>
    </ul>
<?php }
 ?>
</nav>
