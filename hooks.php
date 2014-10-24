<?php
/**
 * Hooks and functionality for WP Marketo
 * 
 * @package Marketo_FAT
 * @author Hutchhouse
 * @author Simon Holloway
 */

/**
 * Ajax hook to get lead info from a cookie
 * 
 * @author Simon Holloway
 * @return void
 */
function marketo_fat_ajax_get_lead() {
    
    if(isset($_COOKIE['_mkto_trk']) && $_REQUEST['form_id']) {
        $marketo_cookie = $_COOKIE['_mkto_trk'];
        $client = get_marketo_client_using_settings();
        $lead = get_marketo_lead_info($client, 'COOKIE', $marketo_cookie);
        $lead = flatten_marketo_lead_info($lead);
        echo json_encode(array('success' => true, 'data' => $lead, 'form_id' => $_REQUEST['form_id']));
    } else {
        echo json_encode(array('success' => false));
    } 
    
    die();
}
add_action('wp_ajax_marketo_ajax_get_lead', 'marketo_fat_ajax_get_lead');
add_action('wp_ajax_nopriv_marketo_ajax_get_lead', 'marketo_fat_ajax_get_lead');

/**
 * Register JS
 * 
 * @author Simon Holloway
 * @return void
 */
function register_marketo_fat_scripts() {
    if($id = get_marketo_settings('marketo_id')) {
        
        $client_available = can_use_marketo_client();
        $prepopulate = get_marketo_settings('prepopulate') && $client_available;
        $popout = get_marketo_settings('popout_enable') && $client_available;
        
        if ($popout) {
            wp_enqueue_style('marketo-forms-popout', MARKETO_FAT_URL . '/css/popout.css');
            
        } 
        
        wp_enqueue_script('marketo-forms', '//app-lon03.marketo.com/js/forms2/js/forms2.js', array(), '1.0.0', false);
        wp_enqueue_script('marketo-fat', MARKETO_FAT_URL . '/js/wp-marketo.js', array('jquery'), '1.0.0', false);
        wp_enqueue_script('marketo-munchkin', MARKETO_FAT_URL . '/js/munchkin.js', array('jquery'), '1.0.0', true);
        wp_localize_script('marketo-fat', 'marketoFat', array(
        	'id' => $id, 
        	'prepopulate' => $prepopulate,
        	'ajaxurl' => admin_url('admin-ajax.php'),
			'popout' => array(
				'enabled' => $popout
			)
		));
    }
}
add_action('wp_enqueue_scripts', 'register_marketo_fat_scripts');

function register_marketo_fat_admin_scripts($hook) {
    wp_enqueue_script('marketo-fat-admin', MARKETO_FAT_URL . '/js/wp-marketo-admin.js', array('jquery'), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'register_marketo_fat_admin_scripts');
