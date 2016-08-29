<?php
use PHPUnit\Framework\TestCase;

require "../src/Item.php";
require "../src/Order.php";
require "../src/Checkout.php";
require "../src/Cart.php";

class OrderTest extends  TestCase{

    /** @test */
    public function add_many_items_to_one_order(){
        $items = [
            new Item(1, 2, 2),
            new Item(2, 1, 4),
            new Item(3, 2, 1),
            new Item(4, 1, 5)
        ];

        $order = new Order();
        $result = $order->add_order($items);
        $this->assertEquals(true, $result instanceof Order);
        $this->assertEquals(true, is_int($result->id));
        $this->assertEquals(true, $result->id > 0);
        $this->assertEquals(15, $result->price);



    }
    /** @test */
    public function get_and_editable_order_states(){
        $status = [
            'pending' ,
            'paid' ,
            'refunded'
        ];
        $order=new Order();
        $this->assertEquals(true ,in_array($order->getStatus($order->id),$status));
        $this->assertEquals(true ,$order->setStatus($order->id,$order->status));

    }
    /** @test */
    public function Convert_cart_to_Order_to_start_checkout(){

        $chkout= new Checkout();
        $order = new Order();
        $cart = new Cart();
        $this->assertEquals('valid',$chkout->IsStartCheckout($order));
        $this->assertEquals(true,$chkout->ConvertToOrder($cart));
    }

}
