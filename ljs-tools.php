<?php

/**
 *
 * @link              https://decided.to
 * @since             1.0.0
 * @package           Ljs_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       LJS Tools
 * Plugin URI:        https://github.com/matebitte/ljs_tools
 * Description:       Fügt post types für Beschlüsse sowie pasende Tags/Kategorien hinzu. Deaktiviert Kommentare. Für updates @bak_it@ljs.social folgen :)
 * Version:           1.0.0
 * Author:            Emilia Leo Weigel
 * Author URI:        https://decided.to
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ljs-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// key: ljs = linksjugend sachsen

/**
 * Include files whom are referenced
 */
include "includes/ljs-comments.php";
include "includes/ljs-post-types.php";
include "includes/ljs-taxonomies.php";
include "includes/ljs-roles.php";
include "admin/ljs-settings.php";

///////////////////////////////////////////////

/**
 * registering various hooks
 */
if (get_option( 'ljs_deactivate_comments' ) == true) {
    // disable comments
    add_action("wp_before__render", "ljs_remove_admin_bar_render");
    add_action("init", "ljs_remove_comment_support");
    add_action("admin_menu", "ljs_remove_comments_admin_menus");
}

if (get_option( 'ljs_add_custom_post_type' ) == true) {
    // add ljp & beschlüsze
    add_action("init", "ljs_add_post_type_beschlusz", 0);
    add_action("init", "ljs_add_taxonomy_plenum", 1);
    add_action("init", "ljs_add_taxonomy_gremium", 1);
    add_action( "admin_menu", "ljs_change_tags_to_themen", 1);
}

// add admin page for simple settings
add_action('admin_menu', 'ljs_add_admin_submenu'); // add admin menu
add_action( 'admin_init', 'ljs_settings_init' ); // initialize settings


///////////////////////////////////////////////


/**
 * The code that runs during plugin activation.
 */
function activate_ljs_tools() {
    // set default options
    // set_option( 'ljs_deactivate_comments' ) == true

    // add ljp & beschlüsze
    ljs_add_post_type_beschlusz();
    ljs_add_taxonomy_plenum();
    ljs_add_taxonomy_gremium();
    ljs_change_tags_to_themen();

    // remove comment post type
    remove_post_type_support("post", "comments");
    remove_post_type_support("page", "comments");

    // remove admin menus for comments
    remove_menu_page('edit-comments.php');

    // remove comment menu from admin bar
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu("comments");

    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules(); 
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_ljs_tools() {
    // enable comments
    remove_action("wp_before__render", "ljs_remove_admin_bar_render");
    remove_action("init", "ljs_remove_comment_support", 100);
    remove_action("admin_menu", "ljs_remove_comments_admin_menus");

    // add ljp & beschlüsze
    remove_action("init", "ljs_add_post_type_beschlusz");
    remove_action("init", "ljs_add_taxonomy_plenum", 0);

    remove_action("init", "ljs_add_taxonomy_gremium", 0);
    remove_action( "admin_menu", "ljs_change_tags_to_themen");

    // Clear the permalinks after the post type has been unregistered.
    flush_rewrite_rules(); 
}

register_activation_hook(__FILE__, 'activate_ljs_tools');
register_deactivation_hook(__FILE__, 'deactivate_ljs_tools');
register_uninstall_hook(__FILE__, 'uninstall_ljs_tools');

// 2023 emilia leo weigel