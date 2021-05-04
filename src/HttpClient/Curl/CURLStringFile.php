<?php

namespace R11baka\Deepai\HttpClient\Curl;

use CURLFile;

class CURLStringFile extends CURLFile
{
    /**
     * CURLStringFile constructor.
     * @param string $data
     * @param string $postname
     * @param string $mime
     */
    public function __construct(string $data, string $postname, string $mime = "application/octet-stream")
    {
        $this->name = 'data://application/octet-stream;base64,' . base64_encode($data);
        $this->mime = mime_content_type($this->name) ?? $mime;
        $this->postname = $postname;
    }
}
