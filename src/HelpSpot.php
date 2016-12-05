<?php

namespace HelpSpot\HelpSpot;

use GuzzleHttp\Exception\ClientException;

class HelpSpot
{

    private $errors = false;
    private $endpoint = '';
    private $username = '';
    private $password = '';
    private $data = [];
    private $guzzle;

    /**
     * Create a new Skeleton Instance
     */
    function __construct($endpoint, $username=false, $password=false)
    {
        $this->endpoint = $endpoint . '/api/index.php?'; //According to guzzle docs we shouldn't need this ? but doesn't work without it.
        $this->username = $username;
        $this->password = $password;

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

        try{

            $result = $this->guzzle->request($http, $this->endpoint,
                    [
                      'auth' => [$this->username, $this->password],
                      'query' => $http == 'get' ?: $this->data,
                      'form_params' => $http == 'post' ?: $this->data
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
