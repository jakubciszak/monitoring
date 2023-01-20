<?php

namespace App\Core\Testing\Repository;

use App\Core\Testing\TestCase;
use App\Infr\Testing\TestMethod;

interface TestMethodRepository
{
    public function findByCase(TestCase $case): TestMethod;
}
