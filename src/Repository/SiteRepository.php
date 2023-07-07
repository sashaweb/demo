<?php

namespace App\Repository;

use App\Entity\Site;
use App\Enum\Status;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Collections\Criteria;

/**
 * @extends ServiceEntityRepository<Site>
 *
 * @method Site|null find($id, $lockMode = null, $lockVersion = null)
 * @method Site|null findOneBy(array $criteria, array $orderBy = null)
 * @method Site[]    findAll()
 * @method Site[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Site::class);
    }

    public function save(Site $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Site $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function deleteExpiredRequests(): void
    {

        $sites = $this->createQueryBuilder('s')      
        ->andWhere('s.createdAt < :d')
        ->andWhere('s.status <> :s')
        ->setParameter('d', new \DateTime("- 30 day"))
        ->setParameter('s', Status::Added)
        ->getQuery()
        ->getResult()
        ;

        foreach ($sites as $site) {
            $this->getEntityManager()->remove($site);
        }

        $this->getEntityManager()->flush();
    }


    public function getExpiredRequestCount(): int
    {
        return $this->createQueryBuilder('s')  
        ->select('count(s)')    
        ->andWhere('s.createdAt < :d')
        ->andWhere('s.status <> :s')
        ->setParameter('d', new \DateTime("- 30 day"))
        ->setParameter('s', Status::Added)
        ->getQuery()
        ->getSingleScalarResult()
        ;
    }


    public function findByCategoryId(int $categoryId): array
    {

        return $this->createQueryBuilder('s')      
        ->leftJoin('s.categories', 'c', 'WITH')
        ->andWhere('c.id = :categoryId')
        ->setParameter('categoryId', $categoryId)
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
    ;
    }

    public function getPaginatorByCategory(int $categoryId, int $page) : Paginator
    {
        $offset = ($page - 1) * self::PAGINATOR_PER_PAGE;

        $query = $this->createQueryBuilder('s')      
        ->leftJoin('s.categories', 'c', 'WITH')
        ->andWhere('c.id = :categoryId')
        ->setParameter('categoryId', $categoryId)
        ->andWhere("s.status = :status")
        ->setParameter('status', Status::Added)
        ->setFirstResult($offset)
        ->setMaxResults(self::PAGINATOR_PER_PAGE)
        ->orderBy('s.createdAt', 'DESC')
        ->getQuery();

        return new Paginator($query, $fetchJoinCollection = false);
    }

    public function getPaginatorByCriteria(int $page, string $term, array $statuses) : Paginator
    {

        $offset = ($page - 1) * self::PAGINATOR_PER_PAGE;

        $qb = $this->createQueryBuilder('s') 
        ->setFirstResult($offset)
        ->setMaxResults(self::PAGINATOR_PER_PAGE)
        ->orderBy('s.createdAt', 'DESC') ;

        if ($term) {
            $qb->andWhere('s.name LIKE :term OR s.domain LIKE :term')
            ->setParameter('term', '%' . $term . '%');
        }

        if ($statuses) {
            $qb->andWhere('s.status IN (' . implode(',',$statuses) . ')');
        } else {
            $statuses = [
                Status::EmailNotConfirmed->value,
                Status::PendingModeration->value,
                Status::PendingPayment,
            ];
            $qb->where("s.status IN(:statuses)");
            $qb->setParameter('statuses', array_values($statuses));
        }

        return new Paginator($qb->getQuery(), $fetchJoinCollection = false);
    }

    public function findByTerm(string $term): array
    {
        return $this->createQueryBuilder('s') 
        ->andWhere('s.name LIKE :term OR s.domain LIKE :term')
        ->setParameter('term', '%' . $term . '%')
        ->setFirstResult(0)
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }

    public function findNewSites(): array
    {
        return $this->createQueryBuilder('s')
        ->where("s.status = :status")
        ->setParameter('status', Status::Added)
        ->orderBy('s.createdAt', 'DESC') 
        ->setFirstResult(0)
        ->setMaxResults(20)
        ->getQuery()
        ->getResult();
    }







//    /**
//     * @return Site[] Returns an array of Site objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Site
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
