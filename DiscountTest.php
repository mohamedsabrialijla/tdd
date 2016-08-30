<?php

class DiscountTest extends TestCase
{

    /*
     * test if a product located in store exist
     */
    public function testItemIfExistsOnStore()
    {
        $item = new Item();
        if (isset($item)) {
            $item->setItemId(153673);
            $this->assertEquals(153673, $item->getItemId());
        } else {
            return false;
        }
    }

    /*
     *  test item discount price changed from original price
     */
    public function testItemDiscountAvailable()
    {
        $discountPrice = new Item();
        $value = $discountPrice->calculateDiscountPercentage(13268, 700.0, 10.0);
        if (is_numeric($value)) {
            $this->assertEquals(630, $value);
        } else {
            return false;
        }
    }

    /*
     * test item discount price available in specific period of time
     */
    public function testDiscountOfItemIsfValidInSpecificInterval()
    {
        $itemPrice = new Item();
        $value = $itemPrice->displayDiscountTimeRange(97262, '2016-07-28', '2016-10-28', '2016-08-28', 350.0);
        if (is_numeric($value)) {
            $this->assertEquals(280, $value);
        } else {
            return false;
        }
    }

    /*
     * test item discount is available
     */
    public function testIfItemIsAvailableInDiscounts()
    {
        $itemOne = new Item();
        $itemOne->setItemId(65462);
        $itemOne->setItemName("Sony Smartphone");
        $itemOne->setItemType("Mobile Phones");
        $itemOne->setItemInitialPrice(700.0);
        $itemOne->setItemDiscountPercentage($itemOne->setItemDiscountPercentage(10));
        $itemOne->setItemDiscountStatus($itemOne->setItemDiscountStatus(true));

        $itemTwo = new Item();
        $itemTwo->setItemId(68146);
        $itemTwo->setItemName("Headphone");
        $itemTwo->setItemType("Consumer Electronics");
        $itemTwo->setItemInitialPrice(100.0);
        $itemTwo->setItemDiscountPercentage($itemOne->setItemDiscountPercentage(30));
        $itemTwo->setItemDiscountStatus($itemOne->setItemDiscountStatus(true));

        $itemThree = new Item();
        $itemThree->setItemId(49726);
        $itemThree->setItemName("HP Envey 13");
        $itemThree->setItemType("Laptops");
        $itemThree->setItemInitialPrice(950.0);
        $itemThree->setItemDiscountPercentage($itemOne->setItemDiscountPercentage(5));
        $itemThree->setItemDiscountStatus($itemOne->setItemDiscountStatus(true));

        $items = [$itemOne, $itemTwo, $itemThree];
        $discountedItemsArray = [];
        if ($itemOne->getItemDiscountStatus() && $itemTwo->getItemDiscountStatus() && $itemThree->getItemDiscountStatus()) {
            array_push($discountedItemsArray, $itemOne, $itemTwo, $itemThree);

        } else {
            return false;
        }
        $this->assertEquals($items, $discountedItemsArray);

    }
}
