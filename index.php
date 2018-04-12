<?php

/*
** the index.php serves as a rooter and redirect to the right controller
*/

if(session_status() != PHP_SESSION_ACTIVE) session_start();

require_once('controller/FoodController.php');
require_once('controller/UserController.php');

try {
    $foodController = new FoodController();
    $userController = new UserController();

    if (isset($_SESSION['userInfo']['id'])){
        if (!isset($_GET['action'])) {
            $foodController->listFood();            
        } else { /* if user is authentified he can interact with app */
            if ($_GET['action'] == 'listFood') {
                $foodController->listFood();
            } elseif ($_GET['action'] == 'accessFoodForm') {
                $id = ( isset($_GET['id']) && $_GET['id'] > 0 ) ? $_GET['id'] : 0;
                $foodController->accessFoodForm($id);
            } elseif ($_GET['action'] == 'addNewFood') {
                if (!empty($_POST['name']) && !empty($_POST['kcal']) && !empty($_POST['proteins'])
                    && !empty($_POST['lipids']) && !empty($_POST['carbohydrate']) && !empty($_POST['fibers'])) {
                        $foodController->addNewFood(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['kcal']),
                        htmlspecialchars($_POST['proteins']), htmlspecialchars($_POST['lipids']),
                        htmlspecialchars($_POST['carbohydrate']), htmlspecialchars($_POST['fibers']));
                } else {
                    throw new Exception('Error : Couldn\'t add food !');
                }
            } elseif ($_GET['action'] == 'updateFood') {
                if (!empty($_POST['name']) && !empty($_POST['kcal']) && !empty($_POST['proteins'])
                    && !empty($_POST['lipids']) && !empty($_POST['carbohydrate']) && !empty($_POST['fibers'])) {
                        $foodController->updateFood(htmlspecialchars($_POST['foodId']), htmlspecialchars($_POST['name']),
                        htmlspecialchars($_POST['kcal']), htmlspecialchars($_POST['proteins']), htmlspecialchars($_POST['lipids']),
                        htmlspecialchars($_POST['carbohydrate']), htmlspecialchars($_POST['fibers']));
                } else {
                    throw new Exception('Error : Couldn\'t update element !');
                }
            } elseif ($_GET['action'] == 'deleteFoodById') {
                if (!empty($_GET['foodId'])) {
                    $foodController->deleteFoodById($_GET['foodId']);
                } else {
                    throw new Exception('Error : Couldn\'t delete food !');
                }
            } elseif ($_GET['action'] == 'userLogout') {
                $userController->userLogout();
            } elseif ($_GET['action'] == 'sortByOption') {
                if (!empty($_GET['opt']) && !empty($_GET['way'])) {
                    $foodController->sortByOption($_GET['opt'], $_GET['way']);
                } else {
                    throw new Exception('Error : Couldn\'t sort food !');
                }
            } elseif ($_GET['action'] == 'searchItem') {
                if (!empty($_GET['searchFor'])) {
                    $foodController->searchItem(htmlspecialchars($_GET['searchFor']));
                } else {
                    throw new Exception('Error : Couldn\'t find food !');
                }
            } elseif ($_GET['action'] == 'editFav') {
                if (!empty($_GET['favId'])) {
                    if (!empty($_GET['isFav'])) {
                        $foodController->deleteFav($_SESSION['userInfo']['id'], htmlspecialchars($_GET['favId']));
                    } else {
                        $foodController->addFav($_SESSION['userInfo']['id'], htmlspecialchars($_GET['favId']));
                    }
                    
                }
            }
        }
    } elseif (isset($_GET['action'])) { /* if user not connected he can register or login */
        if ($_GET['action'] == 'tryToLogin') {
            if (!empty($_POST['userEmail']) && !empty($_POST['userPswd'])) {
                $userController->accessUser(htmlspecialchars($_POST['userEmail']), hash('md5', htmlspecialchars($_POST['userPswd'])));                
            } else {
                throw new Exception('Error : Couldn\'t get email or password!');
            }
        } elseif ($_GET['action'] == 'userRegister') {
            if (!empty($_POST['userEmail']) && !empty($_POST['userPswd'])) {
                $userController->addUser(htmlspecialchars($_POST['userEmail']), hash('md5', htmlspecialchars($_POST['userPswd'])));
            } else {
                throw new Exception('Error : Problem with the identifiers');
            }
        } elseif ($_GET['action'] == 'userRegisterForm') {
            $userController->goToRegister();
        }
    } else { /* default behaviour is redirect toward login form */
        $userController->goToLogin();
    }
} catch(Exception $e) { /* if an error is thrown redirected to the error page with the error message */
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}
