<?php


namespace R11baka\Deepai\HttpClient;


use R11baka\Deepai\Exception\HttpException;

class CurlClient implements HttpClient
{
    /**
     * @var  array<string,string>
     */
    private array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @throws HttpException
     */
    public function do(string $url, string $method, string $body, array $headers): Response
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$responseHeaders) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) // ignore invalid headers
                    return $len;
                $responseHeaders[strtolower(trim($header[0]))][] = trim($header[1]);
                return $len;
            }
        );
        $responseHeaders = [];
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HEADER, $headers);
        }
        if (strtolower($method) === 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        $output = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $error = curl_error($ch);
        if ($error) {
            throw new HttpException(curl_error($ch));
        }
        curl_close($ch);
        return new Response($status, $responseHeaders, $output);
    }
}
