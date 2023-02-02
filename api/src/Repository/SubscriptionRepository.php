<?php

namespace App\Repository;

use App\Entity\Subscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subscription>
 *
 * @method Subscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscription[]    findAll()
 * @method Subscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    public function save(Subscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Subscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findActualSub($company)
    {
        $qb = $this
            ->createQueryBuilder('subscription')

            ->where('subscription.currentPeriodStart < :now')
            ->andWhere('subscription.currentPeriodEnd > :now')
            ->setParameter('now', new \Datetime('now'))

            ->andWhere('subscription.company = :company')
            ->setParameter('company', $company)

            ->leftJoin('subscription.plan', 'plan')
            ->addSelect('plan')

            ->orderBy('subscription.currentPeriodEnd', 'desc')
            ->setMaxResults(1)

            ->getQuery()
        ;

        return $qb->getOneOrNullResult();
    }

    public function findActiveSub($company)
    {
        $qb = $this
            ->createQueryBuilder('subscription')

            ->where('subscription.currentPeriodStart < :now')
            ->andWhere('subscription.currentPeriodEnd > :now')
            ->setParameter('now', new \Datetime('now'))

            ->andWhere('subscription.company = :company')
            ->setParameter('company', $company)

            ->andWhere('subscription.isActive = :true')
            ->setParameter('true', true)

            ->leftJoin('subscription.plan', 'plan')
            ->addSelect('plan')

            ->orderBy('subscription.currentPeriodEnd', 'desc')
            ->setMaxResults(1)

            ->getQuery()
        ;

        return $qb->getOneOrNullResult();
    }

    public function findInactiveSub($company)
    {
        $qb = $this
            ->createQueryBuilder('subscription')

            ->where('subscription.currentPeriodStart < :now')
            ->andWhere('subscription.currentPeriodEnd > :now')
            ->setParameter('now', new \Datetime('now'))

            ->andWhere('subscription.company = :company')
            ->setParameter('company', $company)

            ->orderBy('subscription.currentPeriodEnd', 'desc')
            ->setMaxResults(1)

            ->getQuery()
        ;

        return $qb->getOneOrNullResult();
    }
}
