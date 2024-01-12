<?php

namespace App\Repository;

use App\Entity\MailContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MailContact>
 *
 * @method MailContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailContact[]    findAll()
 * @method MailContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailContact::class);
    }

//    /**
//     * @return MailContact[] Returns an array of MailContact objects
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

//    public function findOneBySomeField($value): ?MailContact
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findContact($id)
{
    return $this->createQueryBuilder('m')
        ->leftJoin('m.expediteur', 's')
        ->where('s.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
}

public function add(MailContact $mailContact): void
{
    try {
        $this->_em->persist($mailContact);
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
}
