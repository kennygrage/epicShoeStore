<?php

    require_once "Shoe.php";

    class Store {

        private $store_name;
        private $id;

        function __construct($store_name, $id = null) {
            $this->store_name = $store_name;
            $this->id = $id;
        }

        function setStoreName($new_store_name) {
            $this->store_name = $new_store_name;
        }

        function getStoreName(){
            return $this->store_name;
        }

        function getId() {
            return $this->id;
        }

        //Save a store to stores table:
        function save() {
            $statement = $GLOBALS['DB']->exec("INSERT INTO stores (store_name)
                    VALUES ('{$this->getStoreName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function getShoes() {
            $query = $GLOBALS['DB']->query("SELECT shoe_id FROM shoes_stores WHERE store_id = {$this->getId()};");
            $shoe_ids = $query->fetchAll(PDO::FETCH_ASSOC);
            $shoes = Array();
            foreach($shoe_ids as $id) {
                $shoe_id = $id['shoe_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM shoes WHERE id = {$shoe_id};");
                $returned_shoe = $result->fetchAll(PDO::FETCH_ASSOC);
                $shoe_name = $returned_shoe[0]['shoe_name'];
                $id = $returned_shoe[0]['id'];
                $new_shoe = new Shoe($shoe_name, $id);
                array_push($shoes, $new_shoe);
            }
            return $shoes;
        }

        function update($new_store_name) {
            $GLOBALS['DB']->exec("UPDATE stores set store_name = '{$new_store_name}' WHERE id = {$this->getId()};");
            $this->setStoreName($new_store_name);
        }

        function addShoe($shoe) {
            $GLOBALS['DB']->exec("INSERT INTO shoes_stores (store_id, shoe_id) VALUES ({$this->getId()}, {$shoe->getId()});");
        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM shoes_stores WHERE store_id = {$this->getId()};");
        }

        //Clear all stores from stores table:
        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        //Retrieve all stores from stores table:
        static function getAll() {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $found_stores = $returned_stores->fetchAll(PDO::FETCH_ASSOC);
            $stores = array();
            foreach ($found_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        //Find stores by id in stores table:
        static function find($search_id) {
            $search_store = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id}");
            $found_store = $search_store->fetchAll(PDO::FETCH_ASSOC);
            $store_name = $found_store[0]['store_name'];
            $id = $found_store[0]['id'];
            $new_shoe = new Store($store_name, $id);
            return $new_shoe;
        }
    }


?>
