<?php

namespace App\Tests\Core\Service;

use App\Core\Common\String\ClearString;
use App\Core\Common\Url;
use App\Core\Service\Exception\InvalidServiceTypeException;
use App\Core\Service\Service;
use App\Core\Service\ServiceType;
use App\Core\Service\Test;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testReturnValidType()
    {
        $service = new Service(
            new ClearString('serviceId'),
            Url::create('https://example.com'),
            new ClearString('Test Service')
        );

        $test = new Test(new ClearString('assert'), new ClearString('status'));
        $service->addTest($test);
        self::assertEquals(ServiceType::HTTP, $service->type());
    }

    public function testInvalidType()
    {
        $this->expectException(InvalidServiceTypeException::class);
        new Service(
            new ClearString('serviceId'),
            Url::create('xhr://example.com'),
            new ClearString('Test Service')
        );
    }

}
