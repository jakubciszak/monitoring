<?php

namespace App\Infr\Service\Repository;

use App\Core\Common\String\ClearString;
use App\Core\Common\Url;
use App\Core\Service\Service;
use App\Core\Service\ServiceRepository;
use App\Core\Service\ServicesCollection;
use App\Core\Service\Test;
use Exception;
use Symfony\Component\Yaml\Yaml;

class ServiceInFileRepository implements ServiceRepository
{
    private array $config;

    public function __construct(string $fileLocation)
    {
        $this->config = (array)Yaml::parseFile($fileLocation);
    }

    /**
     * @throws Exception
     */
    public function getAllServices(): ServicesCollection
    {
        $collection = new ServicesCollection();
        /**
         * @var int $serviceId
         * @var array $serviceData
         */
        foreach ($this->config as $serviceId => $serviceData) {
            $name = $serviceData['name'];
            $url = $serviceData['url'];
            $service = $this->getService($serviceId, $url, $name);

            foreach ($serviceData['tests'] as $stringConfig) {
                $test = Test::fromStringConfig($stringConfig);
                $service->addTest($test);
            }
            $collection->add($service);
        }
        return $collection;
    }

    private function getService(int|string $serviceId, mixed $url, mixed $name): Service
    {
        return new Service(new ClearString($serviceId), Url::create($url), new ClearString($name));
    }
}
