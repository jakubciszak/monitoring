<?php

namespace App\Core\Testing\Gateway;

use App\Core\Common\Url;

interface TestRequest
{
    public function url(): Url;

    public function method(): HttpMethod;

}
