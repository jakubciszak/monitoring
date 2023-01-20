<?php

namespace App\Core\Testing\Repository;

use App\Core\Testing\ProcessTestCase;

interface ProcessTestCaseRepository
{
    public function save(ProcessTestCase $processTestCase): void;
}
