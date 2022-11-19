<?php

namespace App\Repository;

use App\Entity\ImagePlaceholder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImagePlaceholder>
 *
 * @method ImagePlaceholder|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImagePlaceholder|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImagePlaceholder[]    findAll()
 * @method ImagePlaceholder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagePlaceholderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImagePlaceholder::class);
    }

    public function save(ImagePlaceholder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ImagePlaceholder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ImagePlaceholder[] Returns an array of ImagePlaceholder objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImagePlaceholder
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
