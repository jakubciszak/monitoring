<?php

namespace App\Core\Service;

use App\Core\Testing\TestCase;

interface TestDispatcher
{
    public function dispatch(TestCase $test): void;
}
