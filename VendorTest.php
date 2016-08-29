<?php

use PHPUnit\Framework\TestCase;


class VendorTest extends TestCase
{
    /** @test */
    public function vendor_can_only_own_single_store()
    {
        $vendor = new Vendor();

        $store_count = $vendor->get_store_count();

        $this->assertEquals(1, $store_count);

    }

    /** @test */
    public function vendor_can_only_own_single_store2()
    {
        $vendor = new Vendor();

        $this->assertEquals(true, $vendor->addStore(1));
        $this->assertEquals(false, $vendor->addStore(2));

    }

    /** @test */
    public function vendor_can_add_other_manager_to_his_store()
    {

        $manager = new User();
        $manager->name = 'Mohammed';

        $manager2 = new User();
        $manager2->name = 'Ahmed';

        $store = new Store();
        $vendor = new Vendor();
        $vendor->name = 'VVendor';

        $vendor2 = new Vendor();
        $vendor2->name = 'mVendor2';

        $store->setVendor($vendor);

        $res1 = $store->addManager($vendor,$manager);
        $res2 = $store->addManager($vendor,$manager2);

        $res3 = $store->addManager($vendor2,$manager2);

        $managers = count($store->getManagers());

        $this->assertEquals(true, $res1);
        $this->assertEquals(true, $res2);
        $this->assertEquals(2, $managers);
        $this->assertEquals(false, $res3);

    }

    /** @test */
    public function vendor_and_manager_can_add_product_to_store()
    {

        $product = new Product();
        $product->title = 'My product';
        $product->price = 20;


        $store = new Store(1);

        $vendor = new Vendor();
        $vendor->name = 'VVendor';
        $store->setVendor($vendor);

        $manager = new Manager();
        $manager->name = 'Mohammed';

        $user = new User();

        $res1 = $store->addManager($vendor,$manager);


        $this->assertEquals(true, $store->addProduct($product, $vendor));
        $this->assertEquals(true, $store->addProduct($product, $manager));
        $this->assertEquals(false, $store->addProduct($product, $user));
    }




}
