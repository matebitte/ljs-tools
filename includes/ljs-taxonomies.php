<?php

/* 
 * changes the existing post_tag taxonomy into topics.
 * why? cause thats what it should be used for
 */
function ljs_change_tags_to_themen() {
	// rename tag taxonomy in posts
    global $submenu;
    $submenu['edit.php'][16][0] = 'Themen';

	// rename tag taxonomy in beschlusz
    global $submenu;
    $submenu['edit.php?post_type=beschlusz'][15][0] = 'Themen';

	// change object labels
	global $wp_taxonomies;
    $labels = &$wp_taxonomies['post_tag']->labels;
    $labels->name = 'Themen';
    $labels->singular_name = 'Thema';
    $labels->add_new = 'Neues Thema';
    $labels->add_new_item = 'Thema hinzufügen';
    $labels->edit_item = 'Thema bearbeiten';
    $labels->new_item = 'Thema hinzufügen';
    $labels->view_item = 'Thema ansehen';
    $labels->search_items = 'Themen durchsuchen';
    $labels->not_found = 'Keine Themen (sehr unpolitisch hier, lol)';
    $labels->not_found_in_trash = 'Keine trash-Themen (sehr seriös!)';
    $labels->all_items = 'Alle Themen';
    $labels->menu_name = 'Themen';
    $labels->name_admin_bar = 'Themen';

}

// change it back
function ljs_unchange_tag_edits() {
	// rename tag taxonomy
	global $submenu;
	$submenu['edit.php'][16][0] = 'Tags';
}

/* 
 * adds a tag taxonomy for the post type "beschlusz". 
 * ment for community decisions
 */
function ljs_add_taxonomy_plenum()
{
	$labels = array(
		'name'                       => _x('Landesjugendplenum', 'Taxonomy General Name', 'text_domain'),
		'singular_name'              => _x('Landesjugendplenum', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __('Plenen', 'text_domain'),
		'all_items'                  => __('Alle Landesjugendplenen', 'text_domain'),
		'parent_item'                => __('Eltern-Element:', 'text_domain'),
		'parent_item_colon'          => __('Eltern-Element:', 'text_domain'),
		'new_item_name'              => __('Neues LJP', 'text_domain'),
		'add_new_item'               => __('LJP hinzufügen', 'text_domain'),
		'edit_item'                  => __('LJP bearbeiten', 'text_domain'),
		'update_item'                => __('LJP aktualisieren', 'text_domain'),
		'view_item'                  => __('Plenen anzeigen', 'text_domain'),
		'no_terms'                   => __('Keine Plenen (bis jetzt!)', 'text_domain'),
		'items_list'                 => __('Liste aller Plenen', 'text_domain'),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_in_rest'      		 => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy('plenum', array('beschlusz'), $args);
}

/*
 * adds a tag taxonomy in the post type "beschlusz"
 * ment for decisions in elected committees/panels
 */
function ljs_add_taxonomy_gremium()
{
	$labels = array(
		'name'                       => _x('Gremiensitzungen', 'Taxonomy General Name', 'text_domain'),
		'singular_name'              => _x('Beauftragtenrat', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __('Sitzungen', 'text_domain'),
		'all_items'                  => __('Alle Landesjugendplenen', 'text_domain'),
		'parent_item'                => __('Eltern-Element:', 'text_domain'),
		'parent_item_colon'          => __('Eltern-Element:', 'text_domain'),
		'new_item_name'              => __('Neues Landesjugendplenum', 'text_domain'),
		'add_new_item'               => __('Sitzung hinzufügen', 'text_domain'),
		'edit_item'                  => __('Landesjugendplenum bearbeiten', 'text_domain'),
		'update_item'                => __('Landesjugendplenum aktualisieren', 'text_domain'),
		'view_item'                  => __('Landesjugendplenum anzeigen', 'text_domain'),
		'no_terms'                   => __('Keine Elemente', 'text_domain'),
		'items_list'                 => __('Liste von Elementen', 'text_domain'),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_in_rest'      		 => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy('sitzung', array('beschlusz'), $args);
}

// 2023 emilia leo weigel