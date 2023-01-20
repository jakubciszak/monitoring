<?php

namespace App\Core\Testing\Gateway;

use Psr\Http\Message\ResponseInterface;

interface HttpGateway extends Gateway
{
    /**
     * @throws HttpRequestException
     */
    public function send(TestRequest $httpRequest): ResponseInterface;
}
