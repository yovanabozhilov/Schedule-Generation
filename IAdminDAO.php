<?php

namespace model\DAO;

require_once __DIR__ . '/../Presentation.php';
require_once __DIR__ . '/UserDAO.php';
require_once __DIR__ . '/IAdminDAO.php';

use model\Presentation;
use model\DAO\UserDAO;
use model\DAO\IAdminDAO;

interface IAdminDAO{

    public static function saveNewPresentation(Presentation $presentation);
	
	public static function updatePresentation(Presentation $presentation);


}