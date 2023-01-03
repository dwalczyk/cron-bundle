<?php

namespace Dawid\CronBundle\Extension\Doctrine;

use Dawid\CronBundle\PassedJob;
use Dawid\CronBundle\PassedJobsInterfaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrinePassedJobsRepository implements PassedJobsInterfaceRepository
{
    private readonly ObjectRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(PassedJob::class);
    }

    public function getDateTimeOfLastPassedJobByName(string $name): ?\DateTimeInterface
    {
        return $this->repository->findOneBy(
            [
                'name' => $name
            ],
            [
                'passedAt' => 'DESC'
            ]
        )?->getPassedAt();
    }
}