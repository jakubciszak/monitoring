<?php

namespace App\Core\Service;

use App\Core\Common\Collection\CollectionAbstract;

class ServicesCollection extends CollectionAbstract
{
    public function add(Service $service): void
    {
        $this->_add($service);
    }
}
