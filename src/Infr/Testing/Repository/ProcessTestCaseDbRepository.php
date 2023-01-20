<?php

namespace App\Infr\Testing\Repository;

use App\Core\Testing\ProcessTestCase;
use App\Core\Testing\Repository\ProcessTestCaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProcessTestCaseDbRepository extends ServiceEntityRepository implements ProcessTestCaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProcessTestCase::class);
    }

    public function save(ProcessTestCase $processTestCase): void
    {
        $manager = $this->getEntityManager();
        $manager->persist($processTestCase);
        $manager->flush();
    }
}
