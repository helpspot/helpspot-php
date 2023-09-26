<?php

namespace helpspot\helpspot;

use GuzzleHttp\Exception\ClientException;

class helpspot
{

    private $errors = false;
    private $endpoint = '';
    private $username = '';
    private $password = '';
    private $apiKey = '';
    private $data = [];
    private $guzzle;

    /**
     * Create a new Skeleton Instance
     */
    function __construct($endpoint, $username=false, $password=false, $apiKey=false)
    {
        $this->endpoint = $endpoint . '/api/index.php?'; //According to guzzle docs we shouldn't need this ? but doesn't work without it.
        $this->username = $username;
        $this->password = $password;
        $this->apiKey = $apiKey;

        $this->guzzle = new \GuzzleHttp\Client();
    }

    /**
     * Any of the GET based api calls
     */
    function get($method, $data=[])
    {
        return $this->request('GET', $method, $data);
    }

    /**
     * Any of the POST based api calls
     */
    function post($method, $data=[])
    {
        return $this->request('POST', $method, $data);
    }

    /**
     * Handles the HTTP call to HelpSpot
     */
    function request($http, $method, $data=[])
    {
        $this->data = $data;
        $this->data['method'] = $method;

        $headers = [];
        if ($this->apiKey) {
            $headers['Authorization'] = 'Bearer ' . $this->apiKey; // Set the Authorization header if apiKey is present
        }

        try{

            $result = $this->guzzle->request($http, $this->endpoint,
                    [
                      'auth' => $this->apiKey ? null : [$this->username, $this->password], // Don't use basic auth if apiKey is present
                      'headers' => $headers, // Add headers to the request
                      'query' => strtolower($http) == 'get' ? $this->data : null,
                      'form_params' => strtolower($http) == 'post' ? $this->data : null,
                    ]
            );

        } catch (ClientException $e) {
            return $this->errors = new \SimpleXMLElement($e->getResponse()->getBody());
        }

        return new \SimpleXMLElement($result->getBody());
    }

    /**
     * Helper to test for an error
     */
    function hasError()
    {
        return $this->errors ? true : false;
    }

    /**
     * Return the error array
     */
    function getErrors()
    {
        return $this->errors;
    }
}
