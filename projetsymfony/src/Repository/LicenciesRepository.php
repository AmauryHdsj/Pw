<?php

namespace App\Repository;

use App\Entity\Licencies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Licencies>
 *
 * @method Licencies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Licencies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Licencies[]    findAll()
 * @method Licencies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LicenciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Licencies::class);
    }

    public function findLicenciesByCategorie(int $categorieId)
    {
           return $this->createQueryBuilder('l')
            ->leftJoin('l.categorie', 'c')
            ->where('c.id = :categoryId') // Condition pour filtrer les résultats par ID de catégorie
            ->setParameter('categoryId', $categorieId) // Définition du paramètre :categoryId avec la valeur $categoryI
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Licencies[] Returns an array of Licencies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Licencies
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
