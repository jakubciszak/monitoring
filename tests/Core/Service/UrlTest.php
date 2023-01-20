<?php

namespace App\Tests\Core\Service;

use App\Core\Common\Url;
use App\Core\Service\Exception\InvalidUrlException;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testValidUrl(): void
    {
        $url = Url::create('https://www.wp.pl');
        self::assertEquals('https://www.wp.pl', (string)$url);
    }

    /**
     * @dataProvider invalidValues
     */
    public function testInvalidValue(mixed $value): void
    {
        $this->expectException(InvalidUrlException::class);
        Url::create($value);
    }

    public function invalidValues()
    {
        return [
            ['invalidUrl'],
            ['12345'],
            ['<b>www.wp.pl</b>'],
            [''],
            [null],
            [1.12],
        ];
    }
}
