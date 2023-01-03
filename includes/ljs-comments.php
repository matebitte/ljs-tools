<?php

function ljs_remove_comments_admin_menus()
{
    // remove admin menus for comments
    remove_menu_page('edit-comments.php');
}

function ljs_remove_comment_support()
{
    // remove comment post type
    remove_post_type_support("post", "comments");
    remove_post_type_support("page", "comments");
}

function ljs_remove_admin_bar_render()
{
    // remove comment menu from admin bar
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu("comments");
}

// 2023 thalia leo weigel
