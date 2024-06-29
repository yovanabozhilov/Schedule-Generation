<?php


namespace controller;

use controller\AdminController;
use controller\UserController;
use controller\PresentationController;

abstract class AbstractController{


    public static function createController($controller_name)
    {
        $controller_name = ucfirst($controller_name);

        switch ($controller_name) {
            case 'AdminController':
                return AdminController::getInstance();

            case 'UserController':
                return UserController::getInstance();

			case 'PresentationController':
                return PresentationController::getInstance();
				
            default:
                header('location: index.php?page=error');
                die();
        }
    }
}