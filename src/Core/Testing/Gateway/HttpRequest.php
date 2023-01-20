<?php

namespace App\Core\Testing\Gateway;

use App\Core\Common\Url;

class HttpRequest implements TestRequest
{
    public function __construct(
        private readonly Url $url,
        private readonly HttpMethod $method
    ) {
    }

    public function url(): Url
    {
        return $this->url;
    }

    public function method(): HttpMethod
    {
        return $this->method;
    }
}
