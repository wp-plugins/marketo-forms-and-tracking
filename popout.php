<?php
/**
 * Popout form for WP Marketo
 * 
 * @package Marketo_FAT
 * @author Hutchhouse
 * @author Simon Holloway
 */

/**
 * Add the markup to the footer
 * 
 * @author Simon Holloway
 * @return string
 */
function marketo_fat_print_popout() {
    if ( ! get_marketo_settings('popout_enable') ) return;
    
    $title = get_marketo_settings('popout_title');
    $snippet = get_marketo_settings('popout_snippet');
    $tabtext = apply_filters('marketo_fat_tabtext', get_marketo_settings('popout_tabtext'));
    if( ! $tabtext ) $tabtext = 'Follow';
    
    $form = get_marketo_settings('popout_form');
    $form = get_marketo_form($form);
    
    if( ! $form ) return '';
    include(MARKETO_FAT_PATH. '/templates/popout.php');
}
add_filter('wp_footer', 'marketo_fat_print_popout');
