<?php

namespace App\Infr\Testing;

use App\Core\Testing\Exception\TestTypeNotFoundException;
use App\Core\Testing\Repository\TestMethodRepository;
use App\Core\Testing\TestCase;
use Symfony\Component\Yaml\Yaml;

class TestMethodInFileRepository implements TestMethodRepository
{
    private array $config;

    public function __construct(string $fileLocation)
    {
        $this->config = (array)Yaml::parseFile($fileLocation);
    }

    /**
     * @throws TestTypeNotFoundException
     */
    public function findByCase(TestCase $case): TestMethod
    {
        if (!isset($this->config[$case->group()][$case->method()])) {
            throw new TestTypeNotFoundException('Not found');
        }
        $method = $this->config[$case->group()][$case->method()];
        if (!isset($method['types'][$case->type()])) {
            throw new TestTypeNotFoundException('Not found');
        }
        return TestMethod::create($method);
    }
}
