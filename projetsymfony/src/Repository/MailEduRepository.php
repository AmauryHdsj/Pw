<?php

namespace App\Repository;

use App\Entity\MailEdu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MailEdu>
 *
 * @method MailEdu|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailEdu|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailEdu[]    findAll()
 * @method MailEdu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailEduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailEdu::class);
    }

//    /**
//     * @return MailEdu[] Returns an array of MailEdu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MailEdu
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function add(MailEdu $mailEducateur): void
{
    try {
        $this->_em->persist($mailEducateur);
        $this->_em->flush();
    } catch (\Exception $e) {
        // Handle the exception
        echo "An error occurred while sending the mail: " . $e->getMessage();
    }
}



public function delete($id)
{
    $item = $this->find($id);
    if ($item) {
        $this->_em->remove($item);
        $this->_em->flush();
    }
}

public function getEduById($id)
{
    return $this->createQueryBuilder('m')
        ->leftJoin('m.expediteur', 's')
        ->where('s.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
}
}
