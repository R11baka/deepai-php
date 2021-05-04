<?php
declare(strict_types=1);

namespace R11baka\Deepai\HttpClient;


use CURLFile;
use R11baka\Deepai\Exception\HttpException;
use R11baka\Deepai\Exception\IncorrectApiKey;
use R11baka\Deepai\HttpClient\Curl\CURLStringFile;

class CurlClient implements HttpClient
{
    /**
     * @var  array<string,string>
     */
    private array $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @throws HttpException
     * @throws \JsonException
     * @todo use builder pattenr for constucting curl obj
     */
    public function do(string $url, string $method, string $body, array $headers): Response
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseHeaders = [];
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
        if (!empty($headers)) {
            $requestHeaders = array_map(function ($k, $v) {
                return "$v: $k";
            }, $headers, array_keys($headers));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        }
        if (strtolower($method) === 'post') {
            $postData = array(
                'image' => new CURLStringFile($body, 'test.jpg')
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        $output = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error) {
            throw new HttpException(curl_error($ch));
        }
        if ($status === 401) {
            throw new IncorrectApiKey("Please provide correct api-key");
        }
        if ($status !== 200) {
            throw new HttpException("Incorrect status $status");
        }
        return new Response($status, $responseHeaders, $output);
    }
}
