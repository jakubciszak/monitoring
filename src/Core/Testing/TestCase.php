<?php

namespace App\Core\Testing;

class TestCase
{
    public function __construct(
        private readonly string $serviceId,
        private readonly string $type,
        private readonly string $group,
        private readonly string $method,
        private readonly string $url,
        private readonly array $parameters
    ) {
    }

    public function serviceId(): string
    {
        return $this->serviceId;
    }

    public function group(): string
    {
        return $this->group;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}
