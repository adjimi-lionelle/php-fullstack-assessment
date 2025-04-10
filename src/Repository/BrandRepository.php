<?php

namespace App\Repository;

use App\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Brand>
 */
class BrandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
    }

    //    /**
    //     * @return Brand[] Returns an array of Brand objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Brand
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    // Liste des marques en fonction du code pays et du type featured
     public function findByCountryAndFeatured($countryCode): array
     {
        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM brand WHERE JSON_CONTAINS(target_countries, :countryCode) = 1 AND type = :type ORDER BY brand_id DESC';
        $sqlPrepare = $connexion->prepare($sql);
        $result = $sqlPrepare->executeQuery([
            'countryCode' => json_encode($countryCode),
            'type' => "featured"
        ]) ; 
        return $result->fetchAllAssociative();
     }

     // Liste des marques en fonction du code pays et du type bestRated
     public function findByCountryAndBestRated($countryCode): array
     {
        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM brand WHERE JSON_CONTAINS(target_countries, :countryCode) = 1 AND type = :type ORDER BY brand_id DESC';
        $sqlPrepare = $connexion->prepare($sql);
        $result = $sqlPrepare->executeQuery([
            'countryCode' => json_encode($countryCode),
            'type' => "bestRated"
        ]) ; 
        return $result->fetchAllAssociative();
     }

      // Liste des marques en fonction du code pays et du type new
      public function findByCountryAndNew($countryCode): array
      {
         $connexion = $this->getEntityManager()->getConnection();
         $sql = 'SELECT * FROM brand WHERE JSON_CONTAINS(target_countries, :countryCode) = 1 AND type = :type ORDER BY brand_id DESC';
         $sqlPrepare = $connexion->prepare($sql);
         $result = $sqlPrepare->executeQuery([
             'countryCode' => json_encode($countryCode),
             'type' => "new"
         ]) ; 
         return $result->fetchAllAssociative();
      }

      // Liste des marques en fonction du code pays
      public function findByCountryCode($countryCode): array
      {
         $connexion = $this->getEntityManager()->getConnection();
         $sql = 'SELECT * FROM brand WHERE JSON_CONTAINS(target_countries, :countryCode) = 1 ORDER BY brand_id DESC';
         $sqlPrepare = $connexion->prepare($sql);
         $result = $sqlPrepare->executeQuery([
             'countryCode' => json_encode($countryCode)
         ]) ; 
         return $result->fetchAllAssociative();
      }

}
