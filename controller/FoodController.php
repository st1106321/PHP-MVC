<?php

/*
**   The foodController class contains the functions that will interact with the model and call the right view
*/

require_once('model/FoodManager.php');
class FoodController {

    private $foodManager;

    function __construct () {
        $this->foodManager = new FoodManager();
    }

    private function getFavs() {
        $sqlFavs = $this->foodManager->getFavs($_SESSION['userInfo']['id']);
        $ret = [];
        while ($favs = $sqlFavs->fetch_assoc()) {
            foreach ( $favs as $key => $value ) {
                array_push($ret, $value);
            }
        }
        $sqlFavs->close();
        return $ret;
    }

    /* retrieve aliment list from database and loads the related view page */
    public function listFood() {
        $food = $this->foodManager->getFoodList();
        $favs = $this->getFavs();
        if ( !($data = $food->fetch_assoc()) ) $data = "No data available";
        require('view/frontend/listFood.php');
    }
    
    /* retrieve one aliment from database and loads the related view page */
    public function accessFoodForm($id = 0) {
        $foodById = $this->foodManager->getFoodById($id);
        $formValues = ["formHeader" => "Edit Aliment", "formAction" => "updateFood", "itemId" => $id];
        if ( !($data = $foodById->fetch_assoc()) ) {
            $data = ["name"=> "name", "kcal" => 10, "proteins" => 0.1, "lipids" => 0.1, "carbohydrate" => 0.1, "fibers" => 0.1];
            $formValues = ["formHeader" => "Add Aliment", "formAction" => "addNewFood", "itemId" => 0.1];
        }
        require('view/frontend/foodForm.php');
    }

    /* updates one aliment in the database and redirects to listing view page */
    public function updateFood($id, $name, $kcal = 0.1, $proteins = 0.1, $lipids = 0.1, $carbodydrate = 0.1, $fibers = 0.1) {
        $this->foodManager->updateFoodById($id, $name, $kcal, $proteins, $lipids, $carbodydrate, $fibers);
        header('Location: index.php');
    }
    
    /* adds one aliment in the database and redirects to listing view page */
    public function addNewFood($name, $kcal = 0.1, $proteins = 0.1, $lipids = 0.1, $carbodydrate = 0.1, $fibers = 0.1) {
        $this->foodManager->addFoodToDb($name, $kcal, $proteins, $lipids, $carbodydrate, $fibers);
        header('Location: index.php');
    }

    /* deletes one aliment in the database and redirects to listing view page */
    public function deleteFoodById($id) {
        $this->foodManager->deleteFoodById($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function sortByOption($opt, $way) {
        $food = $this->foodManager->sortByOption($opt, $way);
        $favs = $this->getFavs();        
        if ( !($data = $food->fetch_assoc()) ) $data = "No data available";
        require('view/frontend/listFood.php');
    }

    public function searchItem($like) {
        $food = $this->foodManager->searchItem($like);
        $favs = $this->getFavs();        
        if ( !($data = $food->fetch_assoc()) ) $data = "No data available";
        require('view/frontend/listFood.php');
    }

    public function addFav($userId, $ObjId) {
        $favs = $this->getFavs();        
        $this->foodManager->addFav($userId, $ObjId);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deleteFav($userId, $ObjId) {
        $this->foodManager->deleteFav($userId, $ObjId);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function listByFav($user) {
        $food = $this->foodManager->listByFav($user);
        if ( !($data = $food->fetch_assoc()) ) $data = "No data available";
        $favs = $this->getFavs();
        require('view/frontend/listFood.php');
    }
}

