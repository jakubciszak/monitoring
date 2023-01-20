<?php

namespace App\Core\Testing\Tester;

use App\Core\Testing\Gateway\Gateway;
use App\Core\Testing\ProcessTestCase;

interface Tester
{
    public function __construct(Gateway $gateway);

    public function isSatisfiedBy(ProcessTestCase $test): void;
}
