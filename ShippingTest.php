<?php

use PHPUnit\Framework\TestCase;

class ShippingTest extends TestCase{

    /*
     * First Test case
     * User must be able to enter the shipping address
     * */
    public function testUserMustBeAbleToEnterShippingAddress(){


        $client = new Client();
        $client->setName("Ahmed");
        $client->setEmail("ahmad@email.com");
        $address = new Address("115","Al-Nasser St.","Gaza","Palestime");
        $this->assertTrue($client->setAddress($address));

//
//        $shippingService = $this->createMock(ShippingService::class);
//        $shippingService->method('setAddress')->
//        willReturn(true);
//        $this->assertEquals(true,$shippingService->setAddress('Gaza, Palestine'));

    }


    /*
     * Second Test case
     * Shipping service can provide tracking detailes like (estimated time, and current location)
     * */
    public function testShipingServiceCanProvideTrackingDetails(){

        $details = array();
        $details['estimatedTime'] = '12:00pm';
        $details['currentLocation'] = 'Polanda';

        $shippingService = $this->createMock(ShippingService::class);
        $shippingService->method('getDetails')->
        willReturn(array('estimatedTime'=>'12:00pm', 'currentLocation'=>'Polanda'));
        $this->assertEquals($details, $shippingService->getDetails());


    }

    /*
     * Third Test case
     * Successful shipping must change the Order status and send Email to the client
     * */
//    public function testSuccessfulShippingChangeOrderStatusToShippedAndSendEmail()
//    {
//        // Create a stub for the SomeClass class.
//
//        $order = Order::find(123456);
//        $order->ship();
//
//        $this->assertTrue($order->isOrderShipped());
//        $this->assertTrue($order->isIsEmailSent());
//
//
//    }

    /*
         * Third Test case
         * Successful shipping must change the Order status and send Email to the client
         * */
    public function testSuccessfulShippingChangeOrderStatusToShippedAndSendEmail()
    {
        // Create a ship Service Class.
        $ship = $this->createMock(ShippingService::class);

        // Configure the ship.
        $ship->method('isOrderShipped')->willReturn(true);

        $order = Order::find(123456);

        $this->assertTrue($order->checkShippingStatus($ship));
        $this->assertEquals("Shipped",$order->getStatus());

        $client = $order->getClient();
        $mailCollector = $client->getProfile()->getCollector('Shipped_Message');
        // Check that an email was sent
        $this->assertEquals(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting email data
        $this->assertInstanceOf('Shipped_Message', $message);
        $this->assertEquals('Order No 123456 was Shipped', $message->getSubject());
        $this->assertEquals('send@example.com', key($message->getFrom()));
        $this->assertEquals('recipient@example.com', key($message->getTo()));
        $this->assertEquals(
            'Your Order was Shipped',
            $message->getBody()
        );

    }
    public function testFailureShippingOrderStatusStillShipingAndNoMessageSent()
    {
        // Create a stub for the SomeClass class.
        $ship = $this->createMock(ShippingService::class);

        // Configure the stub.
        $ship->method('isOrderShipped')->willReturn(true);

        $order = Order::find(123456);

        $this->assertFalse($order->checkShippingStatus($ship));
        $this->assertEquals("Shiping",$order->getStatus());

        $client = $order->getClient();
        $mailCollector = $client->getProfile()->getCollector('Shipped_Message');
        // Check that an email was sent
        $this->assertEquals(0, $mailCollector->getMessageCount());



    }

}
