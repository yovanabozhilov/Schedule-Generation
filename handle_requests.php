<?php
spl_autoload_register(function ($class) {
    $class_name = str_replace("\\", "/", $class);

    if (strstr($class_name, "model/DAO/") !== false) {
        require_once "./" . $class_name . ".php";
    } elseif (strstr($class_name, "controller/") !== false) {
        require_once "./" . $class_name . ".php";
    } elseif (strstr($class_name, "Controller") !== false) {
      
    } else {
        require_once $class_name . ".php";
    }
});

model\DAO\AbstractDAO::init();

$file_not_found = false;

if (isset($_GET['target']) && isset($_GET['action'])) {
    $controller_name = htmlentities($_GET['target']);
    $method_name = htmlentities($_GET['action']);

    $controller_class_name = "controller\\" . ucfirst($controller_name) . "Controller";

    if (class_exists($controller_class_name)) {
        $class = $controller_class_name::getInstance(); 

        if (method_exists($class, $method_name)) {
            try {
				  if ($method_name === 'exportToExcel' || $method_name === 'exportToPdf' || $method_name === 'exportToZip' ) {
					$htmlTable = $class->generateHTMLTable(); 
					$class->$method_name($htmlTable); 
                } else {
                    $class->$method_name(); 
                }
            } catch (\PDOException $e) {
                echo $e->getMessage();
                die();
            }
        } else {
            $file_not_found = true;
        }
    } else {
        $file_not_found = true;
    }
}

if ($file_not_found) {
    header("HTTP/1.1 404 Not Found");
    header("Location: index.php?page=error");
    exit;
} else {
    header("Location: index.php?page=main");
    exit;
}
?>

