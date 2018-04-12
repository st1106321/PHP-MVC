<?php

/*
**  Makes requests to the database to get values from users table
*/

require_once("model/Manager.php");
class UserManager extends Manager {

    /* returns one user attributes */
    public function getUser($email, $pswd){
        $sql = "SELECT id FROM users WHERE email='{$email}' AND pswd='{$pswd}'";
        return ($this->isQueryOk($sql, "Error: Couldn\'t log in."));
    }

    /* creates one user to the database */
    public function addUserToDb($email, $pswd) {
        // $time = time();
        $sql = "INSERT INTO users(email, pswd, regDate) VALUES ('{$email}', '{$pswd}')";
        return ($this->isQueryOk($sql, "Error: Couldn\'t add user."));
    }

    public function addFavorite($fav) {
        
    }

    // /* returns users attributes */
    // public function getUserList(){
    //     $sql = "SELECT * from users";
    //     return ($this->isQueryOk($sql, "Error: Couldn\'t find items."));
    // }    

    // /* updates aliments attributes */
    // public function updateFoodById($id, $name, $kcal) {
    //     $sql = "UPDATE food SET name='{$name}', kcal='${kcal}' WHERE id={$id}";
    //     return ($this->isQueryOk($sql, "Error: Couldn\'t edit item."));
    // }

    // /* delete one aliment from the database */
    // public function deleteFoodById($foodID){
    //     $sql = "DELETE FROM food WHERE id IN ({$foodID});";
    //     return ($this->isQueryOk($sql, "Error: Couldn\'t delete item."));
    // }
}

