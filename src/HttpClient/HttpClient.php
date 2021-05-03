<?php


namespace R11baka\Deepai\HttpClient;


interface HttpClient
{
    /**
     * @param string $url
     * @param string $method
     * @param string $body
     * @param array $headers
     * @return Response
     */
    public function do(string $url, string $method, string $body, array $headers): Response;
}
