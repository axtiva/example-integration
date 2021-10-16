<?php

namespace App\Repository;

use App\Entity\CodedCurrency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodedCurrency|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodedCurrency|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodedCurrency[]    findAll()
 * @method CodedCurrency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodedCurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodedCurrency::class);
    }

    public function getEntity(int $code): CodedCurrency
    {
        $entity = $this->find($code);

        if (empty($entity)) {
            $entity = new CodedCurrency($code);
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }

        return $entity;
    }

    // /**
    //  * @return CodedCurrency[] Returns an array of CodedCurrency objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CodedCurrency
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
