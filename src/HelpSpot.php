<?php

namespace HelpSpot\HelpSpot;

use GuzzleHttp\Exception\ClientException;

class HelpSpot
{

    private $endpoint = '';
    private $username = '';
    private $password = '';
    private $data = [];
    private $error = false;

    /**
     * Create a new Skeleton Instance
     */
    function __construct($endpoint, $username=false, $password=false)
    {
        $this->endpoint = $endpoint . '/api/index.php?'; //According to guzzle docs we shouldn't need this ? but doesn't work without it.
        $this->username = $username;
        $this->password = $password;
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
     * Helper for uploading documents
     */
    function upload($request_id, $name, $mime, $body)
    {
        // upload as sep operation (messes up history) or just adds to data array?

        //base64 the body
        //File1_sFilename
        //File1_sFileMimeType
        //File1_bFileBody
    }

    /**
     * Handles the HTTP call to HelpSpot
     */
    function request($http, $method, $data=[])
    {
        $this->data = $data;
        $this->data['method'] = $method;

        $client = new \GuzzleHttp\Client();

        try{
            $result = $client->request(
                    $http,
                    $this->endpoint . $method,
                    [
                      'auth' => [$this->username, $this->password],
                      'query' => $http == 'get' ?: $this->data,
                      'form_params' => $http == 'post' ?: $this->data
                    ]
            );
        } catch (ClientException $e) {
            $this->error = true;

            return new \SimpleXMLElement($e->getResponse()->getBody());
        }

        return new \SimpleXMLElement($result->getBody());
    }

    /**
     * Helper to test for an error
     */
    function hasError()
    {
        return $this->error;
    }
}
