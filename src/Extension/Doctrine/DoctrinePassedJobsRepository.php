<?php

namespace Dawid\CronBundle\Extension\Doctrine;

use Dawid\CronBundle\PassedJob;
use Dawid\CronBundle\PassedJobsRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrinePassedJobsRepository implements PassedJobsRepositoryInterface
{
    private readonly ObjectRepository $repository;

    public function __construct(private readonly EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(PassedJob::class);
    }

    /**
     * @return PassedJob[]
     */
    public function findAll(): iterable
    {
        /** @var PassedJob[] $objs */
        $objs = $this->repository->findAll();

        return $objs;
    }

    public function save(PassedJob $job): void
    {
        if (!$this->em->contains($job)) {
            $this->em->persist($job);
        }
        $this->em->flush();
    }
}