<?php
declare(strict_types=1);

namespace App\Core\Service;

use App\Core\Common\String\ClearString;
use App\Core\Common\Url;
use App\Core\Service\Exception\InvalidServiceTypeException;
use ValueError;

class Service
{
    private ServiceType $type;
    private TestsCollection $tests;

    public function __construct(private readonly ClearString $id, private readonly Url $serviceUrl, private readonly ClearString $name)
    {
        $this->type = $this->resolveType();
        $this->tests = new TestsCollection();
    }

    public function id(): ClearString
    {
        return $this->id;
    }

    public function type(): ServiceType
    {
        return $this->type;
    }

    private function resolveType(): ServiceType
    {
        try {
            return ServiceType::fromUrl($this->serviceUrl);
        } catch (ValueError) {
            throw new InvalidServiceTypeException('Invalid service type.');
        }
    }

    public function name(): ClearString
    {
        return $this->name;
    }

    public function tests(): TestsCollection
    {
        return $this->tests;
    }

    public function addTest(Test $test): void
    {
        $this->tests->add($test);
    }

    public function url(): Url
    {
        return $this->serviceUrl;
    }
}
