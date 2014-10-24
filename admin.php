<?php
/**
 * Alchemy Definitions and helpers for WP Marketo
 * 
 * @package Marketo_FAT
 * @author Hutchhouse
 * @author Simon Holloway
 */

/**
 * Register the settings page
 * 
 * @author Simon Holloway
 * @return void
 */
function register_marketo_settings() {
    add_menu_page( 'Marketo', 'Marketo', 'manage_options', 'marketo_fat', 'print_marketo_settings', 'dashicons-groups', 90 ); 
}
add_action('admin_menu', 'register_marketo_settings');

/**
 * Print the settings page
 * 
 * @author Simon Holloway
 * @return void
 */
function print_marketo_settings() {
    extract(get_marketo_settings());
    require(MARKETO_FAT_PATH . '/templates/admin.php');
}

/**
 * Save settings on a marketo_save action
 * 
 * @author Simon Holloway
 * @return void
 */
function save_marketo_settings() {
    
    // Only run when $_REQUEST['marketo_save'] is set
    if( ! isset($_REQUEST['marketo_save']) ) return; 
    
    // Die if not post
    if($_SERVER['REQUEST_METHOD'] !== 'POST') wp_die('This request must be sent with a post request');
    // Die if can't manage_options
    if( ! current_user_can('manage_options') ) wp_die('you do not have authorization to view this page');
    
    
    
    update_option('marketo_fat', $_REQUEST['marketo']);

    /**
     * Handle settings errors and return to options page
     */
    // If no settings errors were registered add a general 'updated' message.
    add_settings_error('marketo_fat', 'settings_updated', __('Settings saved.'), 'updated');
    set_transient('settings_errors', get_settings_errors(), 30);
    
    $goback = add_query_arg( 'settings-updated', 'true',  wp_get_referer() );
    wp_redirect( $goback );
    exit;
}
add_action('admin_init', 'save_marketo_settings');
 
/**
 * Helper to get the settings
 * 
 * @author Simon Holloway
 * @param  string $key
 * @return mixed
 */
function get_marketo_settings($key = null) {
    
    $defaults = array(
        'marketo_id' => '',
        'marketo_base_url' => '',
        'user_id' => '',
        'end_point' => '',
        'user_id' => '',
        'secret' => '',
        'prepopulate' => '',
		'popout_title' => '',
		'popout_tabtext' => '',
		'popout_snippet' => '',
		'popout_form' => '',
	    'popout_enable' => ''
    );
	
    $settings = get_option('marketo_fat', array());
    $settings = wp_parse_args($settings, $defaults);
    if($key)
    {
        $settings = isset($settings[$key]) && ! empty($settings[$key]) ? $settings[$key] : false ;
    }
    
    return $settings;
}
