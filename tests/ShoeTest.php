<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

//Linking class for testing
require_once "src/Shoe.php";
require_once "src/Store.php";

//Setting server up to apache and mysql passwords.
$server = 'mysql:host=localhost;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class ShoeTest extends PHPUnit_Framework_TestCase {

    //Clears data for next test after each test
    protected function tearDown() {
        Shoe::deleteAll();
        Store::deleteAll();
    }

    //Test getters:
    function test_getShoeName() {

        //Arrange
        $shoe_name = "Nike";
        $id = 1;
        $test_shoe = new Shoe($shoe_name, $id);
        $test_shoe->save();

        //Act
        $result = $test_shoe->getShoeName();

        //Assert
        $this->assertEquals($result, $shoe_name);
    }

    function testSetShoeName() {
        //Arrange
        $shoe_name = "Nike";
        $id = 1;
        $test_shoe = new Shoe($shoe_name, $id);

        //Act
        $test_shoe->setShoeName("Adidas");
        $result = $test_shoe->getShoeName();

        //Assert
        $this->assertEquals("Adidas", $result);
    }



}// End class

?>
