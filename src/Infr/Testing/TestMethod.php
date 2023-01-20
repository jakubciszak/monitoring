<?php

namespace App\Infr\Testing;

class TestMethod
{
    private array $types = [];

    public static function create(array $method)
    {
        $testMethod = new self();
        foreach ($method['types'] as $type => $class) {
            $testMethod->addType($type, $class);
        }
        return $testMethod;
    }

    public function addType(string $name, string $class): void
    {
        $this->types[$name] = $class;
    }

    public function types(): array
    {
        return $this->types;
    }
}
