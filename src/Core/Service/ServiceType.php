<?php

namespace App\Core\Service;

use App\Core\Common\Url;
use ValueError;

enum ServiceType: string
{
    case HTTP = 'http';

    /**
     * @throws ValueError
     */
    public static function fromUrl(Url $url): self
    {
        preg_match('#^([a-z]*)://[a-zA-Z\-_.\\/]*$#', (string)$url, $scheme);
        if (empty($scheme[1])) {
            throw new ValueError('Element does not exists.');
        }
        return match ($scheme[1]) {
            'http', 'https' => self::HTTP,
            default => throw new ValueError('Element does not exists.')
        };
    }
}
