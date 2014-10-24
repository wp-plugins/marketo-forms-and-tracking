<?php
/**
 * Wrapper for a soap client and header
 *
 * @package Marketo_FAT
 * @author Hutchhouse
 * @author Simon Holloway
 */
class WP_Marketo_Client {
    
    /**
     * The SoapClient object
     *
     * @var SoapClient
     */
    private $client;
    
    /**
     * The SoapHeader object
     *
     * @var SoapHeader
     */
    private $headers;
    
    /**
     * An options array
     *
     * @var array
     */
    private $options;
    
    /**
     * Set up the object
     * 
     * @param SoapClient $client
     * @param SoapHeader $headers
     * @param array      $options
     */
    public function __construct(SoapClient $client, SoapHeader $headers, array $options)
    {
        $this->client = $client;
        $this->headers = $headers;
        $this->options = $options;
    }
    
    /**
     * Call a SOAP method
     * 
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    private function call($method, $params)
    {
        try {
            $response = $this->client->__soapCall($method, $params, $this->options, $this->headers);
            return $response;
        } catch (Exception $e) {
            var_dump($e);
        }
    }
    
    /**
     * Call a SOAP method
     * 
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        $params = (isset($params[0])) ? $params[0] : array();
        return $this->call($method, $params);
    }
    
}
