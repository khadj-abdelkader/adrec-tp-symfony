<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    /**
     * @param string $order
     * @return int|mixed|string
     */
    public function findAllOrderBy(string $order = 'ASC') {
        return $this->createQueryBuilder('country')
            ->select('country', 'artists')
            // LEFT JOIN artist
            // ON artist.country_id = country.id
            ->leftJoin('country.artists', 'artists')
            ->orderBy('country.name', $order)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $id
     * @return int|mixed|string
     * @throws NonUniqueResultException
     */
    public function findById(string $id) {
        return $this->createQueryBuilder('country')
            ->select('country', 'artists')
            // LEFT JOIN artist
            // ON artist.country_id = country.id
            ->leftJoin('country.artists', 'artists')
            ->where('country.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return Nationality[] Returns an array of Nationality objects
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
    public function findOneBySomeField($value): ?Nationality
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
