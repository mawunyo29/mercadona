<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Product[]    findByWordingField($value)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByWordingField($value): array
    {
        $query = $this->createQueryBuilder('p')
            ->select('c', 'p')
            ->join('p.category', 'c');

        if (!empty($value->search)) {
            $query->andWhere('LOWER(p.wording) LIKE LOWER(:query)')
                ->orderBy('p.wording', $value->order ?? 'ASC')
                ->setParameter('query', "%" . strtolower($value->search) . "%");
        }

        if (!empty($value->price)) {
            $query->andWhere('p.price BETWEEN :min AND :max')
                ->setParameter('min', $value->price->min)
                ->setParameter('max', $value->price->max);
        }
        if (!empty($value->categories) && is_array($value->categories)) {
            $scalarCategories = array_filter($value->categories, 'is_scalar');

            if (!empty($scalarCategories)) {
                $query->andWhere('c.id IN (:categories)')
                    ->setParameter('categories', $scalarCategories);
            }
        }

        return $query->getQuery()->getResult();
    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function sortByName($value): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p'. $value->sort, $value->order)
            ->getQuery()
            ->getResult();
    }
}
