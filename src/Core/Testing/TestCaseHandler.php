<?php

namespace App\Core\Testing;

use App\Core\Testing\Repository\ProcessTestCaseRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class TestCaseHandler
{
    public function __construct(
        private readonly TesterFactory $testerFactory,
        private readonly ProcessTestCaseRepository $processTestCaseRepository
    ) {
    }

    public function __invoke(TestCase $case)
    {
        $tester = $this->testerFactory->createByCase($case);
        $process = ProcessTestCase::new($case);
        $process->execute($tester);
        $this->processTestCaseRepository->save($process);
    }
}
