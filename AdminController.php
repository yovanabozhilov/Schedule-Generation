<?php

namespace controller;

require_once __DIR__ . '/../model/DAO/AdminDAO.php';
require_once __DIR__ . '/../model/DAO/IAdminDAO.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Presentation.php';
require_once __DIR__ . '/../model/DAO/PresentationDAO.php';
require_once __DIR__ . '/AbstractController.php';


use model\DAO\AdminDAO;
use model\DAO\IAdminDAO;
use model\DAO\PresentationDAO;
use model\User;
use model\Presentation;
use controller\AbstractController;



class AdminController extends AbstractController
{

    private static $instance;


    private function __construct()
    {
        if (isset($_SESSION['user'])) {
            $user_in_session = &$_SESSION['user'];
            if ($user_in_session->getisAdmin()) {

            } else {
                header("location: index.php?page=error");
                die("Only admin");
            }
        }

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new AdminController();
        }
        return self::$instance;
    }


    public static function addPresentation(){
  
    $title = htmlentities($_POST['title']);
	$date = htmlentities($_POST['date']);
	$author = htmlentities($_POST['author']);
	$fn = htmlentities($_POST['fn']);
    $hour = htmlentities($_POST['hour']); 
    $room = htmlentities($_POST['room']);
	$Interests = htmlentities($_POST['Interests']);
    try {
       
        $presentation = new \model\Presentation(null, $title, $date, $author, $fn, $hour, $room , $Interests);

      
        $adminDAO = new \model\DAO\AdminDAO();
        $adminDAO->saveNewPresentation($presentation);

        
        header('Location: index.php?page=admin_main');
        exit();
    } catch (\PDOException $e) {
   
        header('HTTP/1.1 500 Server Error');
        die($e->getMessage());
    }
	}
	
	public static function editPresentation() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        
        $id = htmlentities($_POST['id']);
        $title = htmlentities($_POST['title']);
		$date = htmlentities($_POST['date']);
        $author = htmlentities($_POST['author']);
		$fn = htmlentities($_POST['fn']);
        $hour = htmlentities($_POST['hour']);
        $room = htmlentities($_POST['room']);
		$Interests = htmlentities($_POST['Interests']);

        try {
            $presentation = new \model\Presentation($id, $title, $date, $author, $fn, $hour, $room, $intersts);

            $adminDAO =  new \model\DAO\AdminDAO();
            $adminDAO->updatePresentation($presentation);

            header('Location: index.php?page=admin_main');
            exit();
        } catch (\PDOException $e) {
            header('HTTP/1.1 500 Server Error');
            die($e->getMessage());
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        die("Invalid request");
    }

	}}

}
