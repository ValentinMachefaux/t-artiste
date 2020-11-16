<?php

namespace App\Repository;

use App\Entity\Oeuvre;
use App\Entity\OeuvreExposee;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OeuvreExposee|null find($id, $lockMode = null, $lockVersion = null)
 * @method OeuvreExposee|null findOneBy(array $criteria, array $orderBy = null)
 * @method OeuvreExposee[]    findAll()
 * @method OeuvreExposee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OeuvreExposeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OeuvreExposee::class);
    }

    // /**
    //  * @return OeuvreExposee[] Returns an array of OeuvreExposee objects
    //  */
    
    // public function jointure($value)
    // {
    //     return $this->createQueryBuilder('o')
    //         ->from(Oeuvre::class,'oe')
    //         ->innerJoin(OeuvreExposee::class,'e',Join::WITH,'oe.id = e.id_oeuvre') 
    //         ->where('e.id_exposition = :val')
    //         ->setParameter('val',$value)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    // public function jointure($value)
    // {
    //     $conn = $this->getEntityManager()->getConnection();

    //     $sql = '
    //     SELECT * FROM oeuvre o 
    //     INNER JOIN oeuvre_exposee e  ON o.id = e.id_oeuvre 
    //     WHERE e.id_exposition = :val
    //     ';
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute(['val' => $value]);
    //     return $stmt->fetchAllAssociative();
    // }
    
    public function jointure($value)
    {
        $conn = $this->getEntityManager();
        $sql=$conn-> createQuery('
                SELECT o FROM App\Entity\OeuvreExposee oe
                INNER JOIN App\Entity\Oeuvre o WITH o.id = oe.id_oeuvre 
                INNER JOIN App\Entity\Exposition e WITH e.id = oe.id_exposition
                WHERE e.id ='.$value
            );
        return $sql->getResult();
    }

    /*
    public function findOneBySomeField($value): ?OeuvreExposee
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
