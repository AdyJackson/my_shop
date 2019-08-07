<?php

namespace App\Repository;

use App\Entity\ShopUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ShopUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopUser[]    findAll()
 * @method ShopUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ShopUser::class);
    }

    // /**
    //  * @return ShopUser[] Returns an array of ShopUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShopUser
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
