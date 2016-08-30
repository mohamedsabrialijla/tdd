<?php

class ProductTest extends TestCase
{

public function testProduct()
{

$productX = new Product();
$productX -> title = "apple";
$productX -> description = "wwwww";
$productX -> price = "50";


$this->assertEquals("apple" , $productX->title);
$this->assertEquals("wwwww" , $productX->description);
$this->assertEquals("50" , $productX->price);


}
public function testCategory(){
$productY = new Product();

$cats = array() ;

$cat1 = new Category();
$cat1->name = "Vegtables";

$cat2 = new Category();
$cat2->name = "Fruits";

array_push($cats , $cat1);
array_push($cats , $cat2);

$this->assertEquals(0 , $productY->setcategory($cats) );

}

public function testBrowseProductCategory(){

$category1 = new Category();
$category2 = new Category();

$product1 = new Product();
$product1->setTitle("Tomato");
$product1->categories = array(
$category1 , $category2
);



}

}
