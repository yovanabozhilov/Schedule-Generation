<?php

namespace model\DAO;

require_once __DIR__ . '/AbstractDAO.php';
require_once __DIR__ . '/IUserDAO.php';
require_once __DIR__ . '/../User.php';

use model\User;
use model\DAO\IUserDAO;
use model\DAO\AbstractDAO;

class UserDAO extends AbstractDAO implements IUserDAO {
 
    public function __construct() {
        parent::init();
    }

    public static function register(User $newUser){
         try {
        $stmt = self::$pdo->prepare(
            "INSERT INTO users (email, firstName, lastName, password, isAdmin) 
             VALUES (?, ?, ?, ?, ?)"
        );


        $email = $newUser->getEmail();
        $firstName = $newUser->getFirstName();
        $lastName = $newUser->getLastName();
        $password = password_hash($newUser->getPassword(), PASSWORD_DEFAULT); // Hash the password
        $isAdmin = $newUser->getIsAdmin();


        $stmt->execute([$email, $firstName, $lastName, $password, $isAdmin]);


        $newUser->setUserId(self::$pdo->lastInsertId());
		
		error_log("User registered successfully: $email");
		
        return $newUser;
		
    } catch (\PDOException $e) {
        error_log("PDOException in UserDAO::register(): " . $e->getMessage());
        error_log("SQL Query: " . $stmt->queryString); 
        error_log("Parameters: " . json_encode([$email, $firstName, $lastName, $password, $isAdmin]));
        throw $e; 
    }
	}
	
    public static function login($email , $password){
        try {
        $stmt = self::$pdo->prepare(
            "SELECT user_id, email, firstName, lastName, password, isAdmin FROM users WHERE email = ?"
        );
        $stmt->execute([$email]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            // Log debug information
            error_log("User found: " . print_r($row, true));
            if (password_verify($password, $row['password'])) {
                $user = new User($row['email'], $row['password'], $row['firstName'], $row['lastName'], $row['isAdmin']);
                $user->setUserId($row['user_id']);
                return $user;
            } else {
                error_log("Password verification failed for user: $email");
            }
        } else {
            error_log("No user found with email: $email");
        }
        return false;
    } catch (\PDOException $e) {
        error_log("PDOException in UserDAO::login(): " . $e->getMessage());
        throw $e;
    }
    }

    public static function getUser($email){
        $user = [];
        $stmt = self::$pdo->prepare(
            "SELECT user_id, email, firstName, lastName, password, isAdmin FROM users WHERE email = ?; ");
			
        $stmt->execute(array($email));
		
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $user = new User($row["email"],$row["password"],$row["firstName"],$row["lastName"],$row["isAdmin"]);
            $user->setPassword($row["password"]);
        }
        return $user;
    }

 }