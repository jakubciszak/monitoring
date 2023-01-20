<?php

namespace App\Core\Testing;

enum TestStatus: int
{
    case NEW = 0;
    case PROCESSING = 1;
    case FAILED = 2;
    case PASSED = 3;
}
