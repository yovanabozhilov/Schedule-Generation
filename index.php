<?php
	require_once __DIR__ . '/controller/AbstractController.php';
	require_once __DIR__ . '/controller/UserController.php';
	require_once __DIR__ . '/controller/AdminController.php';
	require_once __DIR__ . '/model/DAO/AbstractDAO.php';
	

	use model\DAO\AbstractDAO;
	use controller\AbstractController;
	use controller\UserController;
	use controller\AdminController;
	
	spl_autoload_register(                                        
    function ($class) {
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
	                
	header('Content-Type: text/html; charset=UTF-8');
	define('GUEST_PAGE_NAME', 'guest');
	define('LOGIN_PAGE_NAME', 'login');
	define('REGISTER_PAGE_NAME', 'register');
	define('ERROR_PAGE_NAME', 'error');
	define('MAIN_PAGE_NAME', 'main');
	define('ADD_PRESENTATION_PAGE_NAME', 'add_presentation');
	define('EDIT_PRESENTATION_PAGE_NAME', 'edit_presentation');
	define('ADMIN_MAIN_PAGE_NAME' , 'admin_main');
	
	session_start();                               
	
	if (isset($_SESSION['user'])) {              
		$user_in_session = &$_SESSION['user'];    
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title> Разписание на презентации </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./view/assets/css/default.css">
	<link rel="stylesheet" href="./view/assets/css/skeleton.css">
	
    <script src="./view/assets/js/validation.js" type="text/javascript"></script>


</head>
<body>
	<div class="container">
			
		<div id="home" style="display:block">

			<?php
			if (isset($_GET['page'])) {
				$page_name = $_GET['page'];


				if ($page_name === LOGIN_PAGE_NAME || $page_name === REGISTER_PAGE_NAME) {
					if (isset($_SESSION['user'])) {
						echo "user is already logged in";
						$page_name = ERROR_PAGE_NAME;
					}
				}

				if ($page_name !== LOGIN_PAGE_NAME && $page_name !== REGISTER_PAGE_NAME &&
					$page_name !== MAIN_PAGE_NAME  && $page_name !== ADD_PRESENTATION_PAGE_NAME && $page_name !== EDIT_PRESENTATION_PAGE_NAME &&
					$page_name !== ADMIN_MAIN_PAGE_NAME && $page_name !== null) {
					if (!isset($user_in_session)) {
						$page_name = ERROR_PAGE_NAME;

					}
				}
			} else {
				$page_name = GUEST_PAGE_NAME;   
			}
			$page_path = __DIR__ . "\\view\\" . $page_name . ".html";
			if ( $page_name === ADD_PRESENTATION_PAGE_NAME || $page_name === MAIN_PAGE_NAME || $page_name === ADMIN_MAIN_PAGE_NAME  || $page_name === EDIT_PRESENTATION_PAGE_NAME) {
				$page_path = __DIR__ . "\\view\\" . $page_name . ".php";
			}

			if (file_exists($page_path)) {
				require_once $page_path;
			} else {
				$page_name = ERROR_PAGE_NAME;
			}

			?>
		</div>
	</div>
	<script src="./view/assets/js/validation.js" type="text/javascript"></script>

</body>

</html>