<?php

namespace App\Core\Testing;

use App\Core\Common\Identity\Uid;
use App\Core\Common\String\ClearString;
use App\Core\Common\Url;
use App\Core\Testing\Tester\Tester;
use Ramsey\Uuid\UuidInterface;

// świadomie użyto zewnętrznej zależności do Uuid, nie napsuje za dużo, a się przyda

class ProcessTestCase
{
    private TestStatus $status = TestStatus::NEW;

    public function __construct(
        private UuidInterface $processId,
        private TestCase $testCase
    ) {
    }

    public function uid(): UuidInterface
    {
        return $this->processId;
    }

    public function serviceId(): ClearString
    {
        return new ClearString($this->testCase->serviceId());
    }

    public function execute(Tester $tester)
    {
        $tester->isSatisfiedBy($this);
    }

    public function group(): ClearString
    {
        return new ClearString($this->testCase->group());
    }

    public function method(): ClearString
    {
        return new ClearString($this->testCase->method());
    }

    public function status(): TestStatus
    {
        return $this->status;
    }

    public function url(): Url
    {
        return Url::create($this->testCase->url());
    }

    public function failure(): void
    {
        $this->status = TestStatus::FAILED;
    }

    public function pass(): void
    {
        $this->status = TestStatus::PASSED;
    }

    public function parameters(): array
    {
        return $this->testCase->parameters();
    }

    public static function new(
        TestCase $testCase,
    ): self {
        return new self(Uid::random(), $testCase);
    }
}
