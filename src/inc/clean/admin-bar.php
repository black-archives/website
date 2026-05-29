<?php

add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu( 'updates' );        // Remove the updates link
    $wp_admin_bar->remove_menu( 'comments' );       // Remove the comments link
});
