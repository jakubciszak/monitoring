<?php

namespace App\Core\Testing;

use App\Core\Testing\Exception\InvalidTestMethodException;
use App\Core\Testing\Repository\TestMethodRepository;
use App\Core\Testing\Tester\Http\StatusTester;
use App\Core\Testing\Tester\Tester;

class TesterFactory
{
    private array $testers = [];

    public function __construct(
        private readonly TestMethodRepository $testTypes,
        private readonly StatusTester $statusTester
    ) {
        $this->testers[StatusTester::class] = $this->statusTester;
    }

    /**
     * @throws InvalidTestMethodException
     */
    public function createByCase(TestCase $case): Tester
    {
        $method = $this->testTypes->findByCase($case);
        $types = $method->types();
        if (!isset($types[$case->type()])) {
            throw new InvalidTestMethodException('Can not find test method');
        }
        $class = $types[$case->type()];
        if (!isset($this->testers[$class])) {
            throw new InvalidTestMethodException('Can not find tester class');
        }
        return $this->testers[$class];
    }
}
