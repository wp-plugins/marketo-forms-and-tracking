/**
 * Shortcodes
 * 
 * @author Hutchhouse
 * @author Simon Holloway
 * @param {Object} $
 * @param {Object} wpMarketo
 */
(function($){
	
	var $admin;
	
	function send(content) {
		var win = window.dialogArguments || opener || parent || top;
		win.send_to_editor(content);
	}
	
	function buildShortcode(container) {
		var formId = container.find('[name="marketo_form_id"]').val();
		return '[marketo-fat form="' + formId + '"]';
	}
	
	function addForm(e) {
		var target = $(e.currentTarget),
			container = target.closest('#TB_ajaxContent');
		
		send(buildShortcode(container));
	}
	
	$admin = $('body.wp-admin');
	if ($admin.length > 0) {
		$admin.on('click', '.marketo-fat-add-shortcode', addForm);
	}

})(jQuery);