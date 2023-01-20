<?php

namespace App\Core\Service;

use App\Core\Common\Collection\CollectionAbstract;

class TestsCollection extends CollectionAbstract
{
    public function add(Test $test): void
    {
        $this->_add($test);
    }
}
