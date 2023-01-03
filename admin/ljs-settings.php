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



// initialize the settings upon call via hook
function ljs_settings_init (){
    // register settings as, well, SETTINGS for the wp settings API
    add_settings_section(
        'ljs_options_group_modules', // custom slug/id
        __( 'Custom settings', 'my-textdomain' ), //title
        'ljs_setting_section_callback_function',
        'sample-page'
    );

    add_option( 'ljs_deactivate_comments', 'true');
    register_setting( 'ljs_options_group', 'ljs_deactivate_comments', 'ljs_setting_section_callback_function' );
    
    add_option( 'ljs_add_custom_post_type', 'true');
    register_setting( 'ljs_options_group', 'ljs_add_custom_post_type', 'ljs_setting_section_callback_function' );

    // place content in settings page
    add_settings_field(
        'ljs_setting_field', // id/slug of the setting which is used to call its valu later
        __( 'My custom setting field', 'my-textdomain' ),
        'ljs_setting_markup',
        'sample-page',
        'ljs_options_group_modules'
    );

    register_setting( 'sample-page', 'ljs_custom_settings_options' );
}

// construct the settings page
function ljs_configuration_page_contents() {
    ?>
    <h1> <?php esc_html_e( 'LJS Tools Konfigurieren', 'my-plugin-textdomain' ); ?> </h1>
    <form method="POST" action="options.php">
    <?php
    settings_fields( 'sample-page' );
    do_settings_sections( 'sample-page' );
    submit_button();
    ?>
    </form>
    <?php
}

// define contents of the settings page
function ljs_setting_markup() {
    ?>
    <label for="ljs_setting_field"><?php _e( 'My Input', 'my-textdomain' ); ?></label>
    <input type="text" id="ljs_setting_field" name="ljs_setting_field">
    <?php
}

// called from within the settings section
function ljs_setting_section_callback_function() {
    echo '<p>Intro text for our settings section</p>';
}
