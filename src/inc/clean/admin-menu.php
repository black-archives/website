<?php

add_action('admin_menu', function () {
    $is_admin = current_user_can('administrator');

    remove_menu_page('edit-comments.php');

    if (!$is_admin) {
        remove_menu_page('tools.php');
        remove_menu_page('wpseo_dashboard');
    }
});
