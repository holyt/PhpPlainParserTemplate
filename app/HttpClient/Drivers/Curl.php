<?php
namespace App\HttpClient\Drivers;
/**
 * HTTP driver for builtin php curl
 *
 * Class Curl
 * @package App\HttpClient\Drivers
 */

class Curl implements HttpClientDriverInterface
{
    protected $curl;

    /**
     * Get html content by url
     *
     * @param string $url
     * @return string
     */
    public function get(string $url): string  {
        $response = $this->curlLife(function () use($url) {
            $this->setUrl($url);
        });

        return $response;
    }

    /**
     * Safe curl using, with auto closing
     *
     * @param callable|null $callback
     * @return string
     */
    protected function curlLife(callable $callback = null) {

        $this->initCurl();
        $this->setBasicOptions();

        if ($callback) {
            $callback();
        }

        $response = $this->execute();

        $this->closeCurl();

        return $response;
    }

    /**
     * Execute curl object
     * @return string
     */
    protected function execute(): string
    {
         return curl_exec($this->curl);
    }

    /**
     * Set url for curl object
     * @param string $url
     */
    protected function setUrl(string $url)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
    }

    protected function setBasicOptions()
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
    }

    protected function initCurl()
    {
        $this->curl = curl_init();
    }

    protected function closeCurl()
    {
        curl_close($this->curl);
    }
}