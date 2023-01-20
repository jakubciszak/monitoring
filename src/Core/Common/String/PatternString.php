<?php

namespace App\Core\Common\String;

use App\Core\Common\String\Exception\InvalidStringException;
use Exception;

abstract class PatternString
{
    protected string $pattern = '/.*/';
    private string $value;

    /**
     * @throws Exception
     */
    public function __construct(mixed $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    private function validate(mixed $value)
    {
        if (!is_string($value) || !preg_match($this->pattern, $value)) {
            throw $this->getException();
        }
    }

    protected function getException(): Exception
    {
        return new InvalidStringException('Invalid string.');
    }
}
