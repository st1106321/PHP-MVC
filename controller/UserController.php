<?php

/*
**   The userController class contains the functions that will interact with the model and call the right view
*/

require_once('model/UserManager.php');
class UserController {

    private $userManager;

    function __construct () {
        $this->userManager = new UserManager();
    }

    public function accessUser($email, $pswd) {
        $currentUser = $this->userManager->getUser($email, $pswd);
        $userInfo = $currentUser->fetch_assoc();
        $_SESSION['userInfo'] = $userInfo;
        header('Location: index.php');
    }

    /* calls addUser method and redirects to index  */
    public function addUser($email, $pswd) {
        $newUser = $this->userManager->addUserToDb($email, $pswd);
        header('Location: index.php');
    }
    
    /* logout by destroying current session */
    public function userLogout(){
        session_destroy();
        header('Location: index.php');
    }

    /* redirects to login form */
    public function goToLogin() {
        $loginValues = ["formHeader" => "Login", "formAction" => "tryToLogin"];
        require('view/frontend/loginForm.php');
    }

    /* redirects to register form */
    public function goToRegister() {
        $loginValues = ["formHeader" => "Register", "formAction" => "userRegister"];
        require('view/frontend/loginForm.php');
    }

}