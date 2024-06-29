<?php

namespace model\DAO;

require_once __DIR__ . '/../Presentation.php';
require_once __DIR__ . '/UserDAO.php';
require_once __DIR__ . '/IAdminDAO.php';

use model\Presentation;
use model\DAO\UserDAO;
use model\DAO\IAdminDAO;

class AdminDAO extends UserDAO implements IAdminDAO {

    public static function saveNewPresentation(Presentation $presentation){
    try {
        self::$pdo->beginTransaction();

        $stmt = self::$pdo->prepare("INSERT INTO presentation (title, date, author, fn, hour, room, interests) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $title = $presentation->getTitle();
        $date = $presentation->getDate();
        $author = $presentation->getAuthor();
        $fn = $presentation->getFn();
        $hour = $presentation->getHour();
        $room = $presentation->getRoom();
		$Interests = $presentation->getInterest();
        $stmt->execute([$title, $date, $author, $fn, $hour, $room, $Interests]);

        $last_id = self::$pdo->lastInsertId();
        $presentation->setId($last_id);

        self::$pdo->commit();
    } catch (\PDOException $e) {
        self::$pdo->rollBack();
        throw $e;
    }
	}
	
	public static function updatePresentation(Presentation $presentation) {
    try {
        self::$pdo->beginTransaction();

        $stmt = self::$pdo->prepare("UPDATE presentation SET title = ?, date = ?, author = ?, fn = ?, hour = ?, room = ? , interests = ? WHERE id = ?");
        
        $title = $presentation->getTitle();
        $date = $presentation->getDate();
        $author = $presentation->getAuthor();
        $fn = $presentation->getFn();
        $hour = $presentation->getHour();
        $room = $presentation->getRoom();
		$Interests = $presentation->getInterest();
        $id = $presentation->getId();

        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $date);
        $stmt->bindParam(3, $author);
        $stmt->bindParam(4, $fn);
        $stmt->bindParam(5, $hour);
        $stmt->bindParam(6, $room);
		$stmt->bindParam(7, $interests);
        $stmt->bindParam(8, $id);

        $stmt->execute();

        self::$pdo->commit();
    } catch (\PDOException $e) {
        self::$pdo->rollBack();
        throw $e;
    }

	}
	
 

    
	
	
}
