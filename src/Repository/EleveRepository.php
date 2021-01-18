<?php

namespace App\Repository;

use App\Entity\Eleve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Eleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eleve[]    findAll()
 * @method Eleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eleve::class);
    }

    public function selectElevesEtClasses() {
           $qb = $this->createQueryBuilder('e');
           $qb->join('e.classe', 'c')
              ->addSelect('c');
            $query = $qb->getQuery();
        
            return new Paginator($query);
         
    }

    public function selectEleveEtClasse(int $id)  {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('e.id = :id')
           ->join('e.classe', 'c')
           ->addSelect('c')
           ->setParameter('id', $id);
        $query = $qb->getQuery();
        $result =  $query->getResult();
        if(empty($result)){
            return null;
        }else{
            //$eleve = new Eleve();
        $eleve = $result[0];
        return $eleve;
        }
        
}

public function selectElevesParClasse(int $id) {
    $qb = $this->createQueryBuilder('e');
    $qb->join('e.classe', 'c')
       ->addSelect('c')
       ->andWhere('c.id= :id')
       ->setParameter('id', $id);
     $query = $qb->getQuery();
 
     return new Paginator($query);
  
}    

    // /**
    //  * @return Eleve[] Returns an array of Eleve objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Eleve
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
