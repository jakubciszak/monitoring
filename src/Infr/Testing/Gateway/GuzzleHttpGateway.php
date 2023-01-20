<?php

namespace App\Infr\Testing\Gateway;

use App\Core\Testing\Gateway\HttpGateway;
use App\Core\Testing\Gateway\HttpRequestException;
use App\Core\Testing\Gateway\TestRequest;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class GuzzleHttpGateway implements HttpGateway
{
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * @throws HttpRequestException
     */
    public function send(TestRequest $httpRequest): ResponseInterface
    {
        try {
            $request = $this->prepareRequest($httpRequest);
            $response = $this->client->send($request);
        } catch (ClientException $exception) {
            if (!$exception->hasResponse()) {
                $this->throwException($exception);
            }
            $response = $exception->getResponse();
        } catch (GuzzleException $exception) {
            $this->throwException($exception);
        }
        return $response;
    }

    private function prepareRequest(TestRequest $httpRequest): Request
    {
        return new Request(
            $httpRequest->method()->value,
            (string)$httpRequest->url()
        );
    }

    /**
     * @throws HttpRequestException
     */
    private function throwException(Throwable $exception)
    {
        throw new HttpRequestException('Request error', $exception->getCode(), $exception);
    }
}
