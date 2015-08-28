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

    function test_getId() {
        //Arrange
        $shoe_name = "Nike";
        $id = null;
        $test_shoe = new Shoe($shoe_name, $id);
        $test_shoe->save();

        //Act
        $result = $test_shoe->getId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
    }

    //Test save:
    function test_save() {
        //Arrange
        $shoe_name = "Nike";
        $id = null;
        $test_shoe = new Shoe($shoe_name, $id);
        $test_shoe->save();

        //Act
        $result = Shoe::getAll();

        //Assert
        $this->assertEquals([$test_shoe], $result);
    }

    //Test getAll:
    function test_getAll() {
        //Arrange
        $shoe_name = "Nike";
        $id = null;
        $test_shoe = new Shoe($shoe_name, $id);
        $test_shoe->save();

        $shoe_name2 = "Adidas";
        $test_shoe2 = new Shoe($shoe_name2, $id);
        $test_shoe2->save();

        //Act
        $result = Shoe::getAll();

        //Assert
        $this->assertEquals([$test_shoe, $test_shoe2], $result);
    }

    //Test deleteAll:
    function test_deleteAll(){
        //Arrange
        $shoe_name = "Nike";
        $id = null;
        $test_shoe = new Shoe($shoe_name, $id);
        $test_shoe->save();

        $shoe_name2 = "Adidas";
        $test_shoe2 = new Shoe($shoe_name2, $id);
        $test_shoe2->save();

        //Act
        Shoe::deleteAll();
        $result = Shoe::getAll();

        //Assert
        $this->assertEquals([], $result);
    }




}// End class

?>
