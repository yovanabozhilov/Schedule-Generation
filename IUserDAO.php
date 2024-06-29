<?php

namespace model\DAO;

require_once __DIR__ . '/AbstractDAO.php';
require_once __DIR__ . '/UserDAO.php';
require_once __DIR__ . '/../User.php';

use model\User;
use model\DAO\UserDAO;
use model\DAO\AbstractDAO;

interface IUserDAO{

    public static function register(User $newUser);

    public static function login($email , $password);


}