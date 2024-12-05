<?php

namespace App\Tests\Controller;
use App\Controller\CrudController;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class CrudControllerTest extends TestCase
{
    
    public function testAddProduct()
    {
        // Mock the ProductRepository
        $productRepository = $this->createMock(\App\Repository\ProductRepository::class);
        $product = (new Product())
            ->setName('Test Product')
            ->setSlug('test-product')
            ->setDescription('This is a test product')
            ->setPrice(99.99);

        $productRepository->method('addProduct')->willReturn($product);

        // Mock the Request object
        $request = $this->createMock(\Symfony\Component\HttpFoundation\Request::class);
        $request->method('getContent')->willReturn(json_encode([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'This is a test product',
            'price' => 99.99,
        ]));

        // Create an instance of CrudController
        $controller = new CrudController();

        // Call the method and assert the result
        $response = $controller->addProduct($request, $productRepository);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());

        // Decode the response content and check its structure
        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $data);
        $this->assertEquals('Product created successfully', $data['message']);
        $this->assertEquals('Test Product', $data['product']['name']);
        $this->assertEquals('test-product', $data['product']['slug']);
    }


    public function testListProducts()
    {
        // Mock the ProductRepository
        $productRepository = $this->createMock(\App\Repository\ProductRepository::class);
        $productRepository->method('findAll')->willReturn([
            [
                'id' => 1,
                'name' => 'Product 1',
                'slug' => 'product-1',
                'description' => 'Description 1',
                'price' => 10.0,
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'slug' => 'product-2',
                'description' => 'Description 2',
                'price' => 20.0,
            ],
        ]);

        // Create an instance of CrudController
        $controller = new CrudController();

        // Call the method and assert the result
        $response = $controller->listProducts($productRepository);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());

        // Decode the response content and check its structure
        $data = json_decode($response->getContent(), true);
        $this->assertCount(2, $data);
        $this->assertEquals('Product 1', $data[0]['name']);
        $this->assertEquals('Product 2', $data[1]['name']);
    }
}