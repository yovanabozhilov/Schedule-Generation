<body class="main">
    <header>
        <h1 class="logo">Генериране на разписание за презентации</h1>
        <nav class="clear right">
            <a href="./handle_requests.php?target=user&action=logout" id="logout-link">Отписване</a>
        </nav>
    </header>
    <main id="main">
        <h2>Разписание на презентации</h2> 
        <nav  class="nav_bar">
			<a href="index.php?page=edit_presentation">Променяне на презентация</a>
			<a href="index.php?page=add_presentation">Добавяне на презентация</a>
		</nav>
    
	<?php
	require_once __DIR__ . '/../controller/PresentationController.php';
	use controller\PresentationController;
	
	$controller = PresentationController::getInstance();

	echo $controller->generateHTMLTable();
	?>
	</main>
    <footer class="clear center">
        <h6 class="top-30">Made by Yovana and Branka</h6>      
    </footer>
</body>

