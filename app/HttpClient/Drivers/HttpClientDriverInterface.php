<?php
namespace App\HttpClient\Drivers;

interface HttpClientDriverInterface {
    /**
     * Get html content by url
     *
     * @param string $url
     * @return string
     */
    public function get(string $url): string;
}