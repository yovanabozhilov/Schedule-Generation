<?php

namespace controller;

require_once __DIR__ . '/../model/DAO/UserDAO.php';
require_once __DIR__ . '/../model/User.php';

use model\DAO\UserDAO;
use model\User;

class UserController{

    const IS_ADMIN = '1';
    const IS_NOT_ADMIN = '0';
    const SUCCESSFUL_LOGIN_LOCATION = "location: index.php?page=main";
    const LOGOUT_LOCATION = "location: index.php?page=login";
    const MAIN_LOCATION = "location: index.php?page=main";
    const SUCCESSFUL_REGISTER_LOCATION = "location: index.php?page=main";
	const ERROR_LOCATION = "location: index.php?page=error";
    const ADMIN_SUCCESSFUL_LOGIN_LOCATION = "location: index.php?page=admin_main";
	

    private static $instance;


    private function __construct(){
    }


    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new UserController();
        }
        return self::$instance;
    }


    public static function logout(){
		session_start();
		session_unset();
		session_destroy();
		header(self::LOGOUT_LOCATION);
		exit();
    }


    public static function userIsAdmin(){

        $user = $_SESSION["user"];
        $userIsAdmin = $user->getIsAdmin();
        if ($userIsAdmin) {
            return self::IS_ADMIN;
        }else{
            return self::IS_NOT_ADMIN;
        }
    }

 
    public static function login(){
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    try {
        $logged_user = UserDAO::login($email, $password);
		
        if ($logged_user) {
            $_SESSION["user"] = $logged_user;
			$_SESSION["isAdmin"] = $logged_user->getisAdmin(); 
			
			var_dump($_SESSION['user']);
			var_dump($_SESSION['isAdmin']);

        
            if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
                header(self::ADMIN_SUCCESSFUL_LOGIN_LOCATION); 
            } else {
                header(self::SUCCESSFUL_LOGIN_LOCATION); 
            }
            exit();
        } else {
            error_log("Login failed for user: $email");
			echo "log in faild";
            header(self::ERROR_LOCATION);
            exit();
        }
    } catch (\PDOException $e) {
      
        header('HTTP/1.1 500 Server error');
        die($e->getMessage());
    }
}



    public static function register()
    {
        $firstName = htmlentities($_POST["firstName"]);
        $lastName = htmlentities($_POST["lastName"]);
        $email = htmlentities($_POST["email"]);
        $password = htmlentities($_POST["password"]);
        $passwordRepeat = htmlentities($_POST["passwordRepeat"]);
		
        try {
            if ($password !== $passwordRepeat) {
                header('HTTP/1.1 400 Bad Request');
                die("Passwords do not match.");
            }
            $newUser = new \model\User($email, $password, $firstName, $lastName, false);
            UserDAO::register($newUser);
			
            header(self::SUCCESSFUL_REGISTER_LOCATION);
			
        } catch (\RuntimeException $e) {
            die($e->getTraceAsString());
        }
    }


    public static function getLoggedUser(){
        if (isset($_SESSION['user'])){
            $user_in_session = &$_SESSION['user'];
            return $user_in_session;
        }
    }

}

