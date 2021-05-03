<?php


namespace R11baka\Deepai\HttpClient;


class Response
{
    private int $statusCode;
    private array $headers;
    private string $body;

    /**
     * Response constructor.
     * @param $statusCode
     * @param $headers
     * @param $body
     */
    public function __construct($statusCode, $headers, $body)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
