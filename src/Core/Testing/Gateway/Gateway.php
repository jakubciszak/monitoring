<?php

namespace App\Core\Testing\Gateway;

use Psr\Http\Message\ResponseInterface;

interface Gateway
{
    public function send(TestRequest $request): ResponseInterface;
}
