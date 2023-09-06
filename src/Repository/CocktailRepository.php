<?php

namespace App\Repository;

use App\Entity\Cocktail;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * @extends ServiceEntityRepository<Cocktail>
 *
 * @method Cocktail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cocktail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cocktail[]    findAll()
 * @method Cocktail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CocktailRepository extends ServiceEntityRepository
{  
    private $paginatorInterface;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginatorInterface)
    {   
        $this->paginatorInterface = $paginatorInterface;
        
        parent::__construct($registry, Cocktail::class);
    }

    public function add(Cocktail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cocktail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Cocktail[] Returns an array of Cocktail objects where visible is true
    */
   public function findAllCocktailByVisible($visible = true): array
   {
       return $this->createQueryBuilder('c')
           ->Where('c.visible = :val')
           ->setParameter('val', $visible)
           ->orderBy('c.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }


    /**
    * makes pagination to cocktails list
    *@param int $page the page's number
    * @return PaginationInterface
    */
    public function paginatorForCocktailsList (int $page, $visible = 1): PaginationInterface
    {   
        // fetchs all cocktails
        $data = $this->createQueryBuilder('c')
            ->Where('c.visible = :val')
            ->setParameter('val', $visible)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult();

        // makes pagination
        $cocktails = $this->paginatorInterface->paginate($data,$page,12);
        return $cocktails;
    }




//    public function findOneBySomeField($value): ?Cocktail
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
