<?php

namespace App\Core\Common\Identity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Uid
{
    public static function random(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
