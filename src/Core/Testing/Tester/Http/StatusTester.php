<?php

namespace App\Core\Testing\Tester\Http;

use App\Core\Testing\Gateway\Gateway;
use App\Core\Testing\Gateway\HttpMethod;
use App\Core\Testing\Gateway\HttpRequest;
use App\Core\Testing\ProcessTestCase;
use App\Core\Testing\Tester\Tester;
use Throwable;

class StatusTester implements Tester
{
    public function __construct(private readonly Gateway $gateway)
    {
    }

    public function isSatisfiedBy(ProcessTestCase $test): void
    {
        try {
            $httpRequest = $this->prepareRequest($test);
            $response = $this->gateway->send($httpRequest);
            if ($response->getStatusCode() !== $test->parameters()[0]) {
                $test->failure();
                return;
            }
        } catch (Throwable) {
            $test->failure();
            return;
        }
        $test->pass();
    }

    private function prepareRequest(ProcessTestCase $test)
    {
        return new HttpRequest(
            $test->url(),
            HttpMethod::GET
        );
    }
}
