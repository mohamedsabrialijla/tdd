<?php
use PHPUnit\Framework\TestCase;

class ShipmentTest extends TestCase
{

    /** @test */
    public function calculate_shipment_per_weight_for_each_product()
    {
        $product = new Product();
        $product->setWeight(6);

        $shippingCalculator = new ShipmentCalculator();
        $shippingCalculator->setShipmentRatePer1Kg(2);

        $this->assertEquals(12, $shippingCalculator->calculate($product));
    }

    /** @test */
    public function calculate_the_total_shipment_price_for_the_whole_cart()
    {
        $product1 = new Product();
        $product1->setWeight(4);
        $product2 = new Product();
        $product2->setWeight(7);

        $cart = new Cart();
        $cart->addToCart($product1);
        $cart->addToCart($product2);

        $shippingCalculator = new ShipmentCalculator();
        $shippingCalculator->setShipmentRatePer1Kg(2);

        $this->assertEquals(22, $shippingCalculator->calculate($cart));
    }

    /** @test */
    public function shipment_price_cannot_be_less_than_10()
    {
        $product1 = new Product();
        $product1->setWeight(1);
        $product2 = new Product();
        $product2->setWeight(3);

        $cart = new Cart();
        $cart->addToCart($product1);
        $cart->addToCart($product2);

        $shippingCalculator = new ShipmentCalculator();
        $shippingCalculator->setShipmentRatePer1Kg(2);

        $this->assertEquals(10, $shippingCalculator->calculate($cart));
    }

}
?>
