<?php
/* 
 * adds post type for resolutions.
 * assigns it the taxonomies beschluss (itself), 
 */
function ljs_add_post_type_beschlusz()
{
    register_post_type(
        'beschlusz',
        array(
            'labels' => array(
                'name'          => __('Beschlüsse', 'textdomain'),
                'singular_name' => __('Beschluss', 'textdomain'),
				'all_items'     => __('Alle Beschlüsse', 'text_domain'),
            ),
            'public'        => true,
            'has_archive'   => true,
            'show_in_rest'  => true,
            'menu_icon'     => 'dashicons-text',
            'supports'      => array('title', 'editor'),
            'taxonomies'    => array( 'beschlusz', 'plenum', 'gremium', 'post_tag' )
        )
    );
}

// 2023 emilia leo weigel