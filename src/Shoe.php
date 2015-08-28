<?php

class Shoe {

    private $shoe_name;
    private $id;


    function __construct($shoe_name, $id = null) {
        $this->shoe_name = $shoe_name;
        $this->id = $id;
    }

    function setShoeName($new_shoe_name){
        $this->shoe_name = $new_shoe_name;
    }

    function getShoeName(){
        return $this->shoe_name;
    }

    function getId(){
        return $this->id;
    }

    //Add a store to a shoe:
    function addStore($store){
        $GLOBALS['DB']->exec("INSERT INTO shoes_stores (stores_id, shoes_id)
                    VALUES ({$store->getId()}, {$this->getId()});");
    }

    //Get all stores assigned to a shoe:
    function getStores() {
        //join statement
        $found_stores = $GLOBALS['DB']->query("SELECT stores.* FROM
        shoes JOIN shoes_stores ON (shoes.id = shoes_stores.shoes_id)
                 JOIN stores ON (shoes_stores.stores_id = stores.id)
                 WHERE (shoes.id = {$this->getId()});");
         //convert output of the join statement into an array
         $found_stores = $found_stores->fetchAll(PDO::FETCH_ASSOC);
         $shoe_stores = array();
         foreach($found_stores as $found_store) {
             $store_name = $found_store['store_name'];
             $id = $found_store['id'];
             $new_store = new Store($store_name, $id);
             array_push($shoe_stores, $new_store);
         }
         return $shoe_stores;
    }

    //Save a shoe to shoes table:
    function save() {
        $statement = $GLOBALS['DB']->exec("INSERT INTO shoes (shoe_name)
                        VALUES ('{$this->getShoeName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    //change shoe name
    function update($new_shoe_name) {
        $GLOBALS['DB']->exec("UPDATE shoes SET shoe_name = '{$new_shoe_name}' WHERE id = {$this->getId()};");
        $this->setShoeName($new_shoe_name);
    }

    //delete one shoe
    function deleteOne() {
        $GLOBALS['DB']->exec("DELETE FROM shoes WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM shoes_stores WHERE shoes_id = {$this->getId()};");
    }

    //Clear all shoes from shoes table:
    static function deleteAll(){
        $GLOBALS['DB']->exec("DELETE FROM shoes;");
    }

    //Retrieve all shoes from shoes table:
    static function getAll(){
        $returned_shoes = $GLOBALS['DB']->query("SELECT * FROM shoes;");
        $shoes = array();
        foreach ($returned_shoes as $shoe) {
            $shoe_name = $shoe['shoe_name'];
            $id = $shoe['id'];
            $new_shoe = new Shoe ($shoe_name, $id);
            array_push($shoes, $new_shoe);
        }
        return $shoes;
    }

    //Find shoes by id in shoes table:
    //Built finder with DB query string instead of foreach loop.
    static function find($search_id){
        $search_shoe = $GLOBALS['DB']->query("SELECT * FROM shoes WHERE id = {$search_id}");
        $found_shoe = $search_shoe->fetchAll(PDO::FETCH_ASSOC);
        $shoe_name = $found_shoe[0]['shoe_name'];
        $id = $found_shoe[0]['id'];
        $new_shoe = new Shoe($shoe_name, $id);
        return $new_shoe;
    }



}

?>
