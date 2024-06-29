<body class="main">
    <header>
        <h1 class="logo">Генериране на разписание за презентации</h1>
        <nav class="clear right">
            <a href="./handle_requests.php?target=user&action=logout" id="logout-link">Отписване</a>
        </nav>
    </header>
    <main id="main">
        <h2>Разписание на презентации</h2>
        <h6 class="export">Експортни в : </h6>
        <nav class="nav_bar">
            <a href="./handle_requests.php?target=presentation&action=exportToExcel" id="exportToExcel-link">Excel</a>
            <a href="./handle_requests.php?target=presentation&action=exportToPdf" id="exportToPdf-link">Pdf</a>
            <a href="./handle_requests.php?target=presentation&action=exportToZip" id="exportToZip-link">Zip</a>
        </nav>

        <?php
        require_once __DIR__ . '/../controller/PresentationController.php';
		
        use controller\PresentationController;
        
        $controller = PresentationController::getInstance();
        echo $controller->generateHTMLTable();
        ?>
    </main>
</body>

