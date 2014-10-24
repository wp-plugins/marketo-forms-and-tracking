/**
 * Pre Populate Marketo fields
 * 
 * @author Hutchhouse
 * @author Simon Holloway
 * @param {Object} $
 * @param {Object} marketoFat
 */
(function($, marketoFat){
    
    marketoFat.requests = {};
    marketoFat.form = {};
    marketoFat.form.collection = {};
    marketoFat.data = {};
    
    /**
     * Populate a form with data if both form and data requests have returned
     * 
     * @param {integer} formId
     */
    marketoFat.form.populateWithData = function(formId) {
    	var form = marketoFat.form.collection[formId];
		$.each(marketoFat.requests[formId].data, function(key, value) {
			form.find('[name="' + key + '"]').val(value);
		});
    };
    
    /**
     * Fire off notice that a form request was sent
     * 
     * if marketoFat.prepopulate then request lead data from marketo
     * 
     * @param {integer} formId
     */
    marketoFat.form.startRequest = function(formId) {
    	if( ! marketoFat.prepopulate ) return;
    	marketoFat.form.collection[formId] = $('#mktoForm_' + formId);
		marketoFat.data.sendRequest(formId);
    };
    
    /**
     * Fire off notice that a form response has returned
     * 
     * if marketoFat.prepopulate then run marketoFat.form.populateWithData
     * 
     * @param {object} form
     */
    marketoFat.form.finishRequest = function(form) {
    	if( ! marketoFat.prepopulate ) return;
    	var formId = form.getId();
		if (typeof marketoFat.requests[formId] === 'undefined') {
    		marketoFat.requests[formId] = {formFinish : false, dataFinish : false, data: {}};
    	} 
    	marketoFat.requests[formId].formFinish = true;
    	if (marketoFat.requests[formId].dataFinish && marketoFat.requests[formId].formFinish) {
    		marketoFat.form.populateWithData(formId);
    	}
    };
    
    /**
     * Send a request for marketo lead data
     * 
     * on success run marketoFat.data.finishRequest
     * 
     * @param {integer} formId
     */
    marketoFat.data.sendRequest = function(formId) {
		var data = {
			action : 'marketo_ajax_get_lead',
			form_id : formId
		};
		// We can also pass the url value separately from ajaxurl for front end AJAX implementations
		jQuery.post(marketoFat.ajaxurl, data, function(response) {
			if (response.success) {
				marketoFat.data.finishRequest(response.form_id, response.data);
			}
		}, 'json');
    	
    };
    
    /**
     * Fire off notice that a marketo lead data has returned
     * 
     * run marketoFat.form.populateWithData
     * 
     * @param {integer} formId
     * @param {object}  data
     */
    marketoFat.data.finishRequest = function(formId, data) {
		if (typeof marketoFat.requests[formId] === 'undefined') {
    		marketoFat.requests[formId] = {formFinish : false, dataFinish : false, data: {}};
    	} 
    	marketoFat.requests[formId].dataFinish = true;
    	marketoFat.requests[formId].data = data;
    	if (marketoFat.requests[formId].dataFinish && marketoFat.requests[formId].formFinish) {
    		marketoFat.form.populateWithData(formId);
    	}
    };

})(jQuery, marketoFat);

/**
 * Popout Marketo
 * 
 * @author Hutchhouse
 * @author Simon Holloway
 * @param {Object} $
 * @param {Object} marketoFat
 */
(function($, marketoFat){
    
    
    /**
     * Open or close a popout
     * 
     * @param {element}  tab 
     */
    marketoFat.popout.toggle = function(tab) {
        
        
        var $tab = $(tab),
            $popout = $tab.closest('.marketo-fat-popout'),
            $outer = $popout.find('.mfatp-outer'),
            $body = $popout.find('.mfatp-body'),
            tabheight = $tab.outerHeight();
            
            tabheight += parseInt($tab.css('margin-bottom'));
        
        
        if ($outer.height() > tabheight) {
            $outer.animate({'height' : tabheight});
        } else {
            $body.css('height', 'auto');
            $outer.css('height', 'auto');
            var bodyWidth = $body.height();
            $outer.css('height', '0');
            $body.css('height', bodyWidth);
            $outer.animate({'height' : bodyWidth + tabheight});
        }
        
        
    };
    
})(jQuery, marketoFat);
