<?php

namespace App\Core\Common\String;

use App\Core\Common\String\Exception\InvalidClearStringException;

class ClearString extends PatternString
{
    protected string $pattern = '/[a-zA-Z\d_\-.]{1,100}/';

    /**
     * @throws InvalidClearStringException
     */
    protected function getException(): InvalidClearStringException
    {
        return new InvalidClearStringException('Invalid clear string.');
    }
}
