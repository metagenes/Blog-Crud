<?php

namespace App\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use Carbon\Carbon;
use Log;

class ApiUtil
{
    public static function localOauth($endpoint, $parameters = [], $method = 'GET')
    {
        
        $client = new Client;

        $params = [
            'verify' => true,
            'debug' => false,
            'connect_timeout' => 60,
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ];

        $params = array_merge($params, $parameters);

        try
        {   
            $response = $client->request($method, url('oauth') . '/' . $endpoint, $params);

            return [
                'status' => true,
                'data' => json_decode($response->getBody(), TRUE)
            ];
        }
        catch ( \Exception $e )
        {
            record_error('ApiUtils::localOauth: ' . $e->getMessage(), $e);

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        
    }

    public static function get($url, $params = [], $timeout = 10)
    {
        return self::handle($url, $params, 'GET', $timeout);
    }

    public static function post($url, $params = [], $timeout = 10)
    {
        return self::handle($url, $params, 'POST', $timeout);
    }

    public static function put($url, $params = [], $timeout = 10)
    {
        return self::handle($url, $params, 'PUT', $timeout);
    }

    public static function delete($url, $params = [], $timeout = 10)
    {
        return self::handle($url, $params, 'DELETE', $timeout);
    }

    public static function handle($url, $parameters = [], $method = 'GET', $timeout = 10)
    {
        $client = new Client;

        $params = [
            'verify' => false,
            'debug' => false,
            'timeout' => $timeout
        ];

        $params = array_merge($params, $parameters);

        try
        {
            // For testing error only
            // if ( strpos(strtolower($url), 'phone') !== false )
            //     throw new \Exception("Error Processing Request phone", 1);

            $response = $client->request($method, $url, $params);

            return [
                'http_errors' => false,
                'status' => true,
                'status_code' => $response->getStatusCode(),
                'data' => json_decode($response->getBody(), TRUE)
            ];
        }
        catch ( \Exception $e )
        {   
            record_error('ApiUtils::handle: URL -> ' . $url . ' // Message -> ' . $e->getMessage(), $e);

            return [
                'status' => false,
                'status_code' => 404,
                'message' => $e->getMessage(),
            ];
        }
    }
}