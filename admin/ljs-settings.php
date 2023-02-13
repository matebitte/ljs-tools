<?php
// add a section to the tools menu
function ljs_add_admin_submenu (){
    add_management_page( 
        'LJS Tools', // page_title
        'LJS Tools', // menu_title
        'manage_options', // capability required to access the page
        'ljs-tool-preferences', // menu_slug
        'ljs_configuration_page_contents'// callable function
    );
}

function ljs_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="POST">
            <?php
                settings_fields( 'ljs_plugin_options' );
                do_settings_sections( 'ljs_plugin_options' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

// initialize the settings upon call via hook
function ljs_settings_init (){
    register_setting( 'ljs_plugin_options', 'ljs_plugin_options', 'sanitize_callback' );

    // register settings as, well, SETTINGS for the wp settings API
    add_settings_section(
        'ljs_section_features', // custom slug/id
        __( 'Custom features', 'my-textdomain' ), //title
        'ljs_setting_section_callback',
        'ljs_plugin_options'
    );

    add_settings_field(
        'ljs_deactivate_comments', // id/slug of the setting which is used to call its valu later
        __( 'Deactivate comments', 'text_domain' ),
        'feature_comments_render', // function called
        'ljs_plugin_options', // the setting group id
        'ljs_section_features' // section it belongs to
    );

    add_settings_field(
        'ljs_admin_color_scheme',
        __( 'Admin color scheme', 'text_domain' ),
        'feature_color_scheme_render',
        'ljs_plugin_options',
        'ljs_section_features'
    );

    add_settings_field(
        'ljs_feature_beschlusz',
        __( 'Recipe post type', 'text_domain' ),
        'feature_recipe_post_type_render',
        'ljs_plugin_options',
        'ljs_section_features'
    );
}

// construct the settings page
function ljs_configuration_page_contents() {
    ?>
    <h1> <?php esc_html_e( 'LJS Tools Konfigurieren', 'my-plugin-textdomain' ); ?> </h1>
    <form method="POST" action="options.php">
    <?php
    settings_fields( 'ljs_plugin_options' );
    do_settings_sections( 'ljs_plugin_options' );
    submit_button();
    ?>
    </form>
    <?php
}

// render contents of the settings page
function feature_comments_render() {
    $options = get_option( 'ljs_deactivate_comments' );
    ?>
    <input type="checkbox" name="ljs_plugin_options[ljs_deactivate_comments]" <?php checked( $options['ljs_deactivate_comments'], 1 ); ?> value="1">
    <?php
}

function feature_color_scheme_render() {
    $options = get_option( 'ljs_admin_color_scheme' );
    ?>
    <input type="checkbox" name="ljs_plugin_options[ljs_admin_color_scheme]" <?php checked( $options['ljs_admin_color_scheme'], 1 ); ?> value="1">
    <?php
}

function feature_recipe_post_type_render() {
    $options = get_option( 'ljs_feature_beschlusz' );
    ?>
    <input type="checkbox" name="ljs_plugin_options[ljs_feature_beschlusz]" <?php checked( $options['ljs_feature_beschlusz'], 1 ); ?> value="1">
    <?php
}

// called from within the settings section
function ljs_setting_section_callback() {
    echo '<p>Turn individual features on or off below:</p>';
}

function sanitize_callback( $options ) {
    if ( ! isset( $options['feature_comments'] ) ) {
        $options['feature_comments'] = 0;
    }
    if ( ! isset( $options['feature_comments'] ) ) {
        $options['feature_comments'] = 0;
    }
    return $options;
}