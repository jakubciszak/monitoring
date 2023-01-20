<?php
declare(strict_types=1);

namespace App\Core\Common;

use App\Core\Service\Exception\InvalidUrlException;

class Url
{
    private function __construct(private readonly string $url)
    {
    }

    public function __toString(): string
    {
        return $this->url;
    }

    public static function create(mixed $url)
    {
        if (is_string($url) && filter_var($url, FILTER_VALIDATE_URL)) {
            return new self($url);
        }
        throw new InvalidUrlException('invalid url.');
    }
}
