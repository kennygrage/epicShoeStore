<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //Linking class for testing
    require_once "src/Store.php";

    //Setting server up to apache and mysql passwords.
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase {

        //Clears data for next test after each test:
        protected function tearDown() {
            Store::deleteAll();
        }

        //Test getters:
        function test_getStoreName() {

            //Arrange
            $store_name = "Portland Running Company";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals($result, $store_name);
        }

        function testSetStoreName()
        {
            //Arrange
            $store_name = "Portland Running Company";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $test_store->setStoreName("New Balance");
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals("New Balance", $result);
        }

        function test_getId() {

            //Arrange
            $store_name = "Portland Running Company";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }


    } //End Class
?>
