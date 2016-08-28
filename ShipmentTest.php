<?php
use PHPUnit\Framework\TestCase;

class ShipmentTest extends TestCase
{

    /** @test */
    public function calculate_shipment_per_weight_for_each_product()
    {
        $product = new Product(5);

        $shippingCalculator = new ShipmentCalculator();

        $this->assertEquals(18, $shippingCalculator->calculate($product));

        $product->weight = 1;
        $this->assertEquals(10, $shippingCalculator->calculate($product));
    }

    /** @test */
    public function product_must_have_weight(){
        $product = new Product(4);
        $this->assertFalse(false, $product->checkWeight() );

        $this->assertTrue(true, $product->checkWeight() );
    }

    /** @test */
    public function shipment_price_cantot_be_less_than_10(){
        $shippingCalculator = new ShipmentCalculator();

        $this->assertEquals(10, $shippingCalculator->minmumPrice() );
    }

    /** @test */
    public function get_total_weigth(){
        $product1 = new Product(1);
        $product2 = new Product(2);

        $cart = new Cart();
        $cart->addToCart($product1);
        $cart->addToCart($product2);

        $total = $cart->getTotalWeight();
        $this->assertEquals(3, $total );

        $shippingCalculator = new ShipmentCalculator();

        $this->assertEquals(14, $shippingCalculator->calculateCart($cart));
    }
}

class Product {
    public $weight;

    public function __construct($weight) {
        $this->weight = $weight;
    }

    public function checkWeight(){
        if ($this->weight > 0) {
            return true;
        }
        return false;
    }
}

class Cart {
    public  $products = [];

    public function addToCart($product)   {
        $this->products[] = $product;
    }
    public function getTotalWeight()   {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->weight;
        }
        return $total;
    }
}

class ShipmentCalculator {

    public $minmumPricePerShipment = 10;
    public $shipmentRatePer1Kg = 2;

    public function calculate(Product $product)   {
        if($product->weight > 1 ) {
            $newWeight = $product->weight - 1;
            $shipmentPrice = ($this->minmumPricePerShipment) + ($newWeight * $this->shipmentRatePer1Kg);
            return $shipmentPrice;
        }
        else
            return $this->minmumPricePerShipment;

    }

    public function calculateCart(Cart $cart)   {
        $shipmentPrice = ($this->minmumPricePerShipment) + (($cart->getTotalWeight()-1) * $this->shipmentRatePer1Kg);
        return $shipmentPrice;
    }

    public function minmumPrice(){
        return $this->minmumPricePerShipment;
    }

}

?>
