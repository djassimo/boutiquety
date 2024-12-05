<?php

namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


// If you want, you can use the Api Plateform 
class CrudController extends AbstractController
{
    #[Route('/api/products', methods: ['GET'])]
    /**
     * Summary of listProducts
     * @param \App\Repository\ProductRepository $productRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * 
     */
    public function listProducts(ProductRepository $productRepository): JsonResponse
    {
       $data = $productRepository->findAll();
       
       return new JsonResponse($data, 200, []);
    }

    #[Route('/api/product/add', methods: ['POST'])]
    /**
     * Summary of addProduct
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Repository\ProductRepository $productRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addProduct(Request $request, ProductRepository $productRepository): JsonResponse
    {

       $product =  $productRepository->addProduct($request->getContent());

        return new JsonResponse([
            'message' => 'Product created successfully',
            'product' => [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'slug' => $product->getSlug(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
            ]
        ], 201);
    }
}
