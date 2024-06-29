<?php
namespace model\DAO;

require_once __DIR__ . '/AbstractDAO.php';
require_once __DIR__ . '/AdminDAO.php';
require_once __DIR__ . '/IPresentationDAO.php';
require_once __DIR__ . '/../Presentation.php';

use model\Presentation;
use model\DAO\IPresentationDAO;
use model\DAO\AbstractDAO;


class PresentationDAO extends AbstractDAO implements IPresentationDAO{
	
    public function __construct(){
        parent::init();
    }

    public static function getAllPresentations() {
        try {
            $presentations = [];
            $stmt = self::$pdo->prepare("SELECT id, title, date, author, fn, hour, room, interests FROM presentation");
            $stmt->execute();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $presentation = new Presentation(
                    $row["id"],
                    $row["title"],
                    $row["date"],
                    $row["author"],
                    $row["fn"],
                    $row["hour"],
                    $row["room"],
					$row["interests"]
                );
                $presentations[] = $presentation;
            }

            return $presentations;
        } catch (PDOException $e) {
            throw new PDOException("Error fetching presentation: " . $e->getMessage());
        }
    }

    public function getPresentationById($id) { 
        $stmt = self::$pdo->prepare("SELECT * FROM presentation WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
		
		  if ($row) {
            return new Presentation(
                $row["id"],
                $row["title"],
                $row["date"],
                $row["author"],
                $row["fn"],
                $row["hour"],
                $row["room"],
				$row["interests"]
            );
        }
		
		return null; 
    }

    public static function getPresentations($id, $title, $date, $author, $fn, $hour, $room, $interests)
    {
        try {
            $presentations = [];
            $params = [];
            $sql = "SELECT p.id, p.title, p.date, p.author, p.fn, p.hour, p.room
                    FROM presentation p
                    WHERE p.type = ? AND p.author LIKE ? AND p.date LIKE ?";

            if ($sort == "title") {
                $sql .= " ORDER BY p.title ASC";
            } elseif ($sort == "date") {
                $sql .= " ORDER BY p.date ASC";
            } elseif ($sort == "author") {
                $sql .= " ORDER BY p.author ASC";
            } else {
                $sql .= " ORDER BY p.id ASC";
            }

            if ($author == "none") {
                $author = "%";
            }
            if ($date == "none") {
                $date = "%";
            }

			$sql .= " ORDER BY title ASC"; 
			
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$title, $date, $author]);

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $presentation = new Presentation(
                    $row["id"],
                    $row["title"],
                    $row["date"],
                    $row["author"],
                    $row["fn"],
                    $row["hour"],
                    $row["room"],
					$row["interests"]
                );
                $presentations[] = $presentation;
            }

            return $presentations;

        } catch (\PDOException $e) {
            throw $e;
        }
    }
	

	public static function updatePresentationInterest($presentationId, $interests) {
        try {
            $sql = "UPDATE presentation SET Interests = :Interests WHERE id = :id"; 
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':Interests', $interests, \PDO::PARAM_STR);
            $stmt->bindValue(':id', $presentationId, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \Exception("Error updating presentation interest: " . $e->getMessage());
        }
    }
	
	
}
