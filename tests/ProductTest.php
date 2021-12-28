<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProducts()
    {
        /* check status code */
        $this->get('/products');
        $this->assertEquals(
            200, $this->response->getStatusCode()
        );

        /* check error status code */
        $this->get('/products?page=test');
        $this->assertEquals(
            422, $this->response->getStatusCode()
        );

        /* check response status code */
        $this->json('Get', '/products')
            ->seeJson([
                'status' => 1,
            ]);

        /* check response page number */
        $this->json('Get', '/products?category=boot')
            ->seeJson([
                'status' => 1,
                'page' => 1,
            ]);

        /* check less price */
        $this->json('Get', '/products?priceLessThan=1')
            ->seeJson([
                'status' => 1,
                'page' => 1,
                'products' => [],
            ]);

    }
}
