<?php

namespace App\Repository;

use App\Entity\Jeux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\JeuxSearch;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Jeux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jeux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jeux[]    findAll()
 * @method Jeux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JeuxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jeux::class);
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(JeuxSearch $search) : Query
    {
        $query = $this->createQueryBuilder('p');

        if ($search->getPlayer()) {
            $query = $query
                ->andWhere('p.joueursmini <= :player')
                ->andWhere('p.joueursmaxi >= :player')
                ->setParameter('player', $search->getPlayer());
        }

        return $query->getQuery();
    }

    /**
     * @return Jeux[]
     */

    public function findLatest () : array
    {
        return $this->createQueryBuilder('j')
            ->orderBy('j.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }



    // /**
    //  * @return Jeux[] Returns an array of Jeux objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jeux
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
