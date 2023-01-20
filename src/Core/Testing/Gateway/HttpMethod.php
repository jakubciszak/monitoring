<?php

namespace App\Core\Testing\Gateway;

enum HttpMethod: string
{
    case POST = 'POST';
    case GET = 'GET';
    case PUT = 'PUT';
    case PATCH = 'PATCH';

}
