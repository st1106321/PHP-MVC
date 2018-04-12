<?php

/*
**  Makes requests to the database to get values FROM aliment table
*/

require_once("model/Manager.php");
class FoodManager extends Manager {

    private $tableName = "aliments";

    /* returns aliments attributes */
    public function getFoodList(){
        $sql = "SELECT id, name, kcal, proteins, lipids, carbohydrate, fibers FROM {$this->tableName}";
        return ($this->isQueryOk($sql, "Error: Couldn\'t find items."));
    }
    
    /* returns one aliment attributes */
    public function getFoodById($id){
        $sql = "SELECT name, kcal, proteins, lipids, carbohydrate, fibers FROM {$this->tableName} where id={$id}";
        return ($this->isQueryOk($sql, "Error: Couldn\'t find item."));
    }

    /* creates one aliment to the database */
    public function addFoodToDb($name, $kcal = 0, $proteins = 0, $lipids = 0, $carbohydrate = 0, $fibers = 0) {
        $sql = "INSERT INTO {$this->tableName}(name, kcal, proteins, lipids, carbohydrate, fibers)
                VALUES ('{$name}', {$kcal}, {$proteins}, {$lipids}, {$carbohydrate}, {$fibers})";
        return ($this->isQueryOk($sql, "Error: Couldn\'t add item."));   
    }

    /* updates aliments attributes */
    public function updateFoodById($id, $name, $kcal = 0, $proteins = 0, $lipids = 0, $carbohydrate = 0, $fibers = 0) {
        $sql = "UPDATE {$this->tableName} SET name='{$name}', kcal={$kcal},
                proteins={$proteins}, lipids={$lipids}, carbohydrate={$carbohydrate}, fibers={$fibers} WHERE id={$id}";
        return ($this->isQueryOk($sql, "Error: Couldn\'t edit item."));
    }

    /* delete one aliment from the database */
    public function deleteFoodById($foodID){
        $sql = "DELETE FROM {$this->tableName} WHERE id IN ({$foodID});";
        return ($this->isQueryOk($sql, "Error: Couldn\'t delete item."));
    }
    
    /* sort elements */
    public function sortByOption($opt, $way = "asc") {
        $sql = "SELECT id, name, kcal, proteins, lipids, carbohydrate, fibers
                FROM {$this->tableName} ORDER BY {$opt} {$way}";
        return ($this->isQueryOk($sql, "Error: Couldn\'t sort items."));
    }

    public function searchItem($opt) {
        $sql = "SELECT id, name, kcal, proteins, lipids, carbohydrate, fibers
                FROM {$this->tableName} WHERE name LIKE '%{$opt}%'";       
        return ($this->isQueryOk($sql, "Error: Couldn\'t find items."));
    }

    public function getFavs($id) {
        $sql = "SELECT aliment_id FROM users_aliments WHERE user_id={$id}";
        return ($this->isQueryOk($sql, "No favs, sorry!"));
    }

    public function addFav($userId, $objId) {
        // print "foodManager.php";         
        $sql = "INSERT INTO users_aliments(user_id, aliment_id) VALUES ({$userId}, {$objId})";
        return ($this->isQueryOk($sql, "Counld not add fav."));
    }

    public function deleteFav($userId, $objId) {
        $sql = "DELETE FROM users_aliments WHERE user_id = {$userId} AND aliment_id = {$objId}";
        return ($this->isQueryOk($sql, "Counld not add fav."));
    }

}

