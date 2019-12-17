<?php

namespace App\Repository;

use App\Entity\AvtonetAd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method AvtonetAd|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvtonetAd|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvtonetAd[]    findAll()
 * @method AvtonetAd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvtonetAdRepository extends ServiceEntityRepository
{
    private $manager;
    
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, AvtonetAd::class);
        $this->manager = $manager;
    }
    
    public function findOneByAvtonetId($avtonetId): ?AvtonetAd
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.avtonetId = :val')
            ->setParameter('val', $avtonetId)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function insertOne(AvtonetAd $ad): AvtonetAd
    {
        $this->manager->persist($ad);
        $this->manager->flush();
        
        return $ad;
    }
    
    public function update(AvtonetAd $ad): AvtonetAd
    {
        $this->manager->persist($ad);
        $this->manager->flush();
        
        return $ad;
    }
    
    // /**
    //  * @return AvtonetAd[] Returns an array of AvtonetAd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    
    /*
    public function findOneBySomeField($value): ?AvtonetAd
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
