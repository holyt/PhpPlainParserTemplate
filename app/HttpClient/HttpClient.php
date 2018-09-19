<?php
namespace App\HttpClient;

use App\HttpClient\Drivers\HttpClientDriverInterface;

class HttpClient {
    protected $httpClientDriver;

    /**
     * HttpClient constructor.
     * @param HttpClientDriverInterface $httpClientDriver
     */
    public function __construct(HttpClientDriverInterface $httpClientDriver)
    {
        $this->httpClientDriver = $httpClientDriver;
    }

    /**
     * Get html content by url
     *
     * @param string $url
     * @return string
     */
    public function get(string $url):string
    {
        return $this->httpClientDriver->get($url);
    }
}