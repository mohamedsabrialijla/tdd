<?php

use PHPUnit\Framework\TestCase;


class VendorTest extends TestCase
{


    /** @test */
    public function vendor_can_only_own_single_store()
    {
        $vendor = new Vendor();

        /** Set store1 to the vendor must be success  */
        $this->assertEquals(true, $vendor->setStore(1));

        /** if the vendor have store must not able to accept another store  */
        $this->assertEquals(false, $vendor->setStore(2));

        /** When get the vendor store must return the first store, that mean the vendor has only one store  */
        $this->assertEquals(1, $vendor->getStore());

    }

    /** @test */
    public function vendor_can_add_other_manager_to_his_store()
    {
        $store1 = new Store();
        $store1->name = 'Store1';

        $store2 = new Store();
        $store2->name = 'Store2';

        $manager1 = new User();
        $manager1->name = 'Mohammed';

        $manager2 = new User();
        $manager2->name = 'Ahmed';

        /** get $currentUser */
        $currentUser = Auth::user()->id;
        /** set current user as a Vendor to store1 */
        $store1->setVendor($currentUser);

        /** Add manager1 to Store1 (store1 is  currentUser store) */
        $res1 = $store1->addManager($manager1);

        /** Add manager2 to Store1 (store1 is  currentUser store) */
        $res2 = $store1->addManager($manager2);

        /** Vendor can not add managers to another store
         * test to Add manager2 to Store2 (store2 isn't  currentUser store) */
        $res3 = $store2->addManager($manager2);

        /** get a;; managers in Store1 must return 2 */
        $managers = count($store1->getManagers());

        $this->assertEquals(true, $res1);
        $this->assertEquals(true, $res2);
        $this->assertEquals(false, $res3);
        $this->assertEquals(2, $managers);
    }

    /** @test */
    public function vendor_and_manager_can_add_product_to_store()
    {


        /** Add new Store => 'Store1' */
        $store1 = new Store();
        $store1->name = 'Store1';

        /** Add current user as a vendor on Store1 */
        $currentUser = Auth::user()->id;
        $store1->setVendor($currentUser);

        /** Vendor add $product1 to $store1*/
        $product1 = new Product();
        $product1->id = 4;

        $this->assertEquals(true, $store1->addProduct($product1));


        /** Add  Manager1 as a manager to Store1 */
        $manager1 = new User();
        $manager1->id = 2;
        $manager1->name = 'Mohammed';
        $addManagerResult = $store1->addManager($manager1->id);

        /** change the current user to $manager1 */
        Auth::loginUsingId(2);

        $this->assertEquals(true, $store1->addProduct($product1));

        $this->assertEquals(2, count($store1->getProducts()));
    }




}
