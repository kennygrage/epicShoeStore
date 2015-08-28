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
        $shoe_name = "Bob";
        $enroll_date = "2012-10-20";
        $id = 1;
        $test_shoe = new Shoe($shoe_name, $enroll_date, $id);
        $test_shoe->save();

        //Act
        $result = $test_shoe->getShoeName();

        //Assert
        $this->assertEquals($result, $shoe_name);
    }

}// End class

?>
