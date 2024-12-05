<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManagerInterface;

    public function __construct(
        ManagerRegistry $registry,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManagerInterface
     )
    {
        parent::__construct($registry, Product::class);
        $this->serializer = $serializer;
        $this->entityManagerInterface = $entityManagerInterface;
    }


    /**
     * Summary of findAll
     * Return all products
     * or array empty if no products
     * @return array
     */
    public function findAll(): array {
        $products = $this->entityManagerInterface->getRepository(Product::class)->findAll();
        $response[] =  $this->serializer->serialize($products, 'json', ['groups' => ['product_read']]);

        return $response;

    }

    /**
     * Summary of addProduct
     * @param mixed $data
     * @return \App\Entity\Product
     */
    public function addProduct($data): Product {
        $product =  $this->serializer->deserialize($data, Product::class, 'json');

        // Persist the product to the database
        $this->entityManagerInterface->persist($product);
        $this->entityManagerInterface->flush();

        return $product;

    }
    

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
