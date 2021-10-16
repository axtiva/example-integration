<?php

namespace App\Repository;

use App\Entity\NamedCurrency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NamedCurrency|null find($id, $lockMode = null, $lockVersion = null)
 * @method NamedCurrency|null findOneBy(array $criteria, array $orderBy = null)
 * @method NamedCurrency[]    findAll()
 * @method NamedCurrency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NamedCurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NamedCurrency::class);
    }

    public function getEntity(string $name): NamedCurrency
    {
        $entity = $this->find($name);

        if (empty($entity)) {
            $entity = new NamedCurrency($name);
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }

        return $entity;
    }

    // /**
    //  * @return NamedCurrency[] Returns an array of NamedCurrency objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NamedCurrency
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
