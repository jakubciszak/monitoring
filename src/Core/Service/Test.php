<?php

namespace App\Core\Service;

use App\Core\Common\String\ClearString;
use Exception;

class Test
{
    private array $args = [];

    public function __construct(private ClearString $group, private ClearString $method)
    {
    }

    public function setArguments(...$args)
    {
        $this->args = $args;
    }

    public function args(): array
    {
        return $this->args;
    }

    public function group(): ClearString
    {
        return $this->group;
    }

    public function method(): ClearString
    {
        return $this->method;
    }

    /**
     * @throws Exception
     */
    public static function fromStringConfig(string $configString): self
    {
        $data = explode('.', $configString);
        [$group, $method] = $data;
        $params = array_slice($data, 2);
        $test = new self(new ClearString($group), new ClearString($method));
        call_user_func_array([$test, 'setArguments'], $params);
        return $test;
    }

}
