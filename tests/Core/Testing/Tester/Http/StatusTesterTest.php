<?php

namespace App\Tests\Core\Testing\Tester\Http;

use App\Core\Testing\ProcessTestCase;
use App\Core\Testing\TestCase as AppTestCase;
use App\Core\Testing\Tester\Http\StatusTester;
use App\Core\Testing\TestStatus;
use App\Infr\Testing\Gateway\GuzzleHttpGateway;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class StatusTesterTest extends TestCase
{
    /**
     * @dataProvider validDataProvider
     */
    public function testIsSatisfiedBy(string $url, int $status): void
    {
        $testCase = $this->prepareTestCase($url, $status);
        $process = ProcessTestCase::new(
            $testCase
        );
        $tester = new StatusTester(new GuzzleHttpGateway($this->getClient($status)));

        $process->execute($tester);

        self::assertEquals(TestStatus::PASSED, $process->status());
    }

    public function validDataProvider()
    {
        return [
            ['http://127.0.0.1/', 200],
            ['http://127.0.0.1/error', 500],
            ['http://127.0.0.1/notfound', 404],
        ];
    }

    private function prepareTestCase(string $url, int $status): AppTestCase
    {
        return new AppTestCase(
            'serviceId',
            'http',
            'assert',
            'status',
            $url,
            [$status]
        );
    }

    private function getClient(int $status): Client|MockObject
    {
        $client = $this->createMock(Client::class);
        $client->method('send')->willReturn(new Response($status));
        return $client;
    }

    public function testIsNotSatisfiedBy(): void
    {
        $testCase = $this->prepareTestCase('http://veryBadUrl/', 200);
        $process = ProcessTestCase::new(
            $testCase
        );
        $tester = new StatusTester(new GuzzleHttpGateway($this->getClient(404)));

        $process->execute($tester);

        self::assertEquals(TestStatus::FAILED, $process->status());
    }
}
