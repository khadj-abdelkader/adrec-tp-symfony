<?php

namespace App\Repository;

use App\Entity\AlbumArtist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AlbumArtist|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlbumArtist|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlbumArtist[]    findAll()
 * @method AlbumArtist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumArtistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlbumArtist::class);
    }

    // /**
    //  * @return AlbumArtist[] Returns an array of AlbumArtist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AlbumArtist
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
