<?php

namespace model\DAO;

require_once __DIR__ . '/AbstractDAO.php';
require_once __DIR__ . '/PresentationDAO.php';
require_once __DIR__ . '/../Presentation.php';

use model\Presentation;
use model\DAO\PresentationDAO;
use model\DAO\AbstractDAO;

interface IPresentationDAO
{

    public static function getPresentations($id, $title, $date, $author, $fn, $hour, $room , $interests);
    
    public static function getAllPresentations();
    
    public function getPresentationById($id);
	
	public static function updatePresentationInterest($presentationId, $interests);

}