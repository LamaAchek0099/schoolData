<?php

namespace App\Repository;

use App\Entity\Classes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;


/**
 * @extends ServiceEntityRepository<Classes>
 *
 * @method Classes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classes[]    findAll()
 * @method Classes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classes::class);
    }

    public function add(Classes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Classes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findbyName()
    {
        return $this->createQueryBuilder('c')
        ->getQuery()->getResult();
    }
    public function getSearchClasses($classTitle = null , $query=null){

        $qb = $this->createQueryBuilder('c')
                   ->orderBy('c.name', 'DESC');

           if($classTitle && $classTitle !== '') {

             $qb->andWhere('c.name LIKE :classTitle')
                   ->setParameter('classTitle', '%' . $classTitle . '%');
           }
           
           if($query && $query !== '') {

           }
                  
         return $qb->getQuery()->getResult();

    }
    public function findFormPagination(?Classes $classes = null): Query
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.name', 'DESC');

        return $qb->getQuery();
    }


//    /**
//     * @return Classes[] Returns an array of Classes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Classes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
