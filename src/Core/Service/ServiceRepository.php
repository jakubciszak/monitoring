<?php

namespace App\Core\Service;

interface ServiceRepository
{
    public function getAllServices(): ServicesCollection;
}
