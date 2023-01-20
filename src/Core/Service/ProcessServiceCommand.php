<?php

namespace App\Core\Service;

use App\Core\Testing\TestCase;

class ProcessServiceCommand
{
    public function __construct(private readonly ServiceRepository $serviceRepository, private readonly TestDispatcher $testDispatcher)
    {
    }

    public function execute(): void
    {
        $services = $this->serviceRepository->getAllServices();

        /** @var Service $service */
        foreach ($services as $service) {
            foreach ($service->tests() as $test) {
                $case = $this->prepareCase($service, $test);
                $this->testDispatcher->dispatch($case);
            }
        }
    }

    private function prepareCase(Service $service, Test $test)
    {
        return new TestCase(
            (string)$service->id(),
            $service->type()->value,
            (string)$test->group(),
            (string)$test->method(),
            (string)$service->url(),
            $test->args()
        );
    }
}
