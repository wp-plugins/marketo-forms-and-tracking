<?php
/**
 * Shortcode for WP Marketo
 * 
 * @package Marketo_FAT
 * @author Hutchhouse
 * @author Simon Holloway
 */

/**
 * Add the button to the wysiwyg
 * 
 * @author Simon Holloway
 * @param  string $context
 * @return string
 */
function marketo_insert_form_button($context) {
    
    $icon = '<span ';
    $icon .= 'class="wp-media-buttons-icon dashicons dashicons-groups" ';
    $icon .= '></span>';
    
    
    $context .= '<a href="#TB_inline?width=400&inlineId=marketo_fat_popup_container" ' . 
                   'id="insert-media-button" ' . 
                   'class="button thickbox" ' . 
                   'title="Add Marketo Form" ' . 
                '> ' . $icon . ' Add Marketo Form</a>';
    return $context;
}
add_filter('media_buttons_context', 'marketo_insert_form_button', 1);

/**
 * Add the button to the wysiwyg
 * 
 * @author Simon Holloway
 * @param  string $context
 * @return string
 */
function marketo_inline_popup_content() {
    require(MARKETO_FAT_PATH . '/templates/popup.php');
}

add_action('admin_footer',  'marketo_inline_popup_content');

function marketo_fat_form_shortcode( $atts ) {
     extract(shortcode_atts(array(
          'form' => false,
     ), $atts));
     if($form) {
         return get_marketo_form($form);
     } else {
         return '';
     }
}
add_shortcode('marketo-fat', 'marketo_fat_form_shortcode');