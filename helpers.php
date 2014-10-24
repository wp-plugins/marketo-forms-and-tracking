<?php
/**
 * Helpers and functions for WP Marketo
 * 
 * @package Marketo_FAT
 * @author Hutchhouse
 * @author Simon Holloway
 */

 
/**
 * Return form as a string
 * 
 * @author Simon Holloway
 * @param  integer $form_id
 * @return string
 */
function get_marketo_form($form_id, $wrap = true) {
    $marketo_base_url = get_marketo_settings('marketo_base_url');
    $marketo_id = get_marketo_settings('marketo_id');
    if( ! $marketo_id || ! $marketo_base_url ) return '';
    ob_start();
    include(MARKETO_FAT_PATH. '/templates/form.php');
    return ob_get_clean();
}

/**
 * Return Marketo client using details from the database
 * 
 * @author Simon Holloway
 * @return WP_Marketo_Client
 */
function can_use_marketo_client() {
    extract(get_marketo_settings());
    return ( ! empty($end_point) && ! empty($user_id) && ! empty($secret) );
}

/**
 * Return Marketo client using details from the database
 * 
 * @author Simon Holloway
 * @return WP_Marketo_Client
 */
function get_marketo_client_using_settings() {
    extract(get_marketo_settings());
    return get_marketo_client($end_point, $user_id, $secret);
}

/**
 * Take a getLead response and flatten it for JS
 * 
 * @author Simon Holloway
 * @param  stdObject $lead
 * @return array
 */
function flatten_marketo_lead_info($lead) {
    $formatted_lead = array();
    if (is_object($lead) && isset($lead->result->leadRecordList->leadRecord)) {
        $formatted_lead = (array)$lead->result->leadRecordList->leadRecord;
        if (isset($formatted_lead['leadAttributeList']->attribute)) {
            foreach($formatted_lead['leadAttributeList']->attribute as $attr)
            {
                $formatted_lead[$attr->attrName] = $attr->attrValue;
            }
            unset($formatted_lead['leadAttributeList']);
        }
    }
    return $formatted_lead;
}

/**
 * Helper for the getLead method in the Marketo SOAP API
 * 
 * Will attempt to get the lead info using an email, cookie, id or some other field
 * 
 * @author Simon Holloway
 * @param  WP_Marketo_Client $client
 * @param  string            $key
 * @param  string            $value
 * @return stdObject
 */
function get_marketo_lead_info(WP_Marketo_Client $client, $key, $value) {
    try {
        $response = $client->getLead(array('paramsGetLead' => array('leadKey' => array('keyType' => $key, 'keyValue' => $value))));
        return $response;
    } catch (Exception $e) {
        //var_dump($e);
        //Fail Silently
        return false;
    }
}

/**
 * Generate a WP_Marketo_Client for the Marketo SOAP API with passed details
 * 
 * @author Simon Holloway
 * @param  string            $end_point
 * @param  array             $options
 * @return WP_Marketo_Client
 */
function get_marketo_client($end_point,$user_id, $secret) {
    $namespace = 'http://www.marketo.com/mktows/';
    $client_options = array('connection_timeout' => 20, 'location' => $end_point);
    
    $header = get_marketo_client_header($namespace, $user_id, $secret);
    $client = get_marketo_client_body($end_point, $client_options);
    
    return new WP_Marketo_Client($client, $header, $client_options);
}

/**
 * Generate a SoapClient for the Marketo SOAP API 
 * 
 * @author Simon Holloway
 * @param  string     $end_point
 * @param  array      $options
 * @return SoapClient
 */
function get_marketo_client_body($end_point, $options) {
    return new SoapClient($end_point .'?WSDL', $options);
}

/**
 * Generate a SoapHeader for the Marketo SOAP API 
 * 
 * @author Simon Holloway
 * @param  string     $namespace
 * @param  string     $user_id
 * @param  string     $secret
 * @return SoapHeader
 */
function get_marketo_client_header($namespace, $user_id, $secret) {
    // Create Signature
    $dtzObj = new DateTimeZone('America/Los_Angeles');
    $dtObj  = new DateTime('now', $dtzObj);
    $timestamp = $dtObj->format(DATE_W3C);
    $encrypt = $timestamp . $user_id;
    $signature = hash_hmac('sha1', $encrypt, $secret);
    
    // Create SOAP Header
    $attrs = (object)array(
        'mktowsUserId' => $user_id,
        'requestSignature' => $signature,
        'requestTimestamp' => $timestamp
    );
    
    return new SoapHeader($namespace, 'AuthenticationHeader', $attrs);
}
