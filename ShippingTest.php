<?php

use PHPUnit\Framework\TestCase;

class ShippingTest extends TestCase
{
    /** @test */

    public function product_limttation()
    {
        $product = new Product();
        $cart = new Cart();
        $this->assertEquals(true, $cart->addProduct($product));
    }
    public function product_quantity()
    {
        $product = new Product();
        $cart = new Cart();
        $product->setQuantity(10);
        $this->assertGreaterThan(0, $product->getQuantity());
    }

    /** @test */

    public function add_new_product_or_increase_quantity()
    {
        $cart = new Cart();
        $product1 = new Product();
        $product2 = new Product();
        $product1->setName("A");
        $product2->setName("A");
        $this->assertTrue($cart->addProduct($product1));//if product is a new, method will add product and return True
        $this->assertFalse($cart->addProduct($product2));
        //if product is similar another item , method will increase qunt and return  false

    }



}

