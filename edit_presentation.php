<?php
require_once __DIR__ . '/../model/DAO/AbstractDAO.php';
require_once __DIR__ . '/../model/DAO/AdminDAO.php';
require_once __DIR__ . '/../model/DAO/PresentationDAO.php';

use model\DAO\AbstractDAO;
use model\DAO\AdminDAO;
use model\DAO\PresentationDAO;

$presentationDAO = new PresentationDAO();
$presentations = $presentationDAO->getAllPresentations();

if ($presentations === false) {
    die("Error fetching presentations");
}

$selectedPresentation = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $presentationId = $_POST['id'];
    $selectedPresentation = $presentationDAO->getPresentationById($presentationId);
}
?>

<body>
    <header>
        <h1 class="logo">Редактиране на презентация</h1>
        <nav class="clear right">
            <a href="./handle_requests.php?target=user&action=logout" id="logout-link">Отписване</a>
        </nav>
    </header>
    <div class="container">
        <h2>Редактиране на презентация</h2>
        
		<form method="post" action="./handle_requests.php?target=admin&action=editPresentation"> 
			<div class="form-group">
				<label for="presentationSelect">Изберете презентация:</label>
				<select id="presentationSelect"  name="id">
				<option value="">Изберете презентация</option>
				<?php foreach ($presentations as $presentation): ?>
					<?php
						$isSelected = ($selectedPresentation && $selectedPresentation->getId() == $presentation->getId());
						$selectedAttribute = $isSelected ? 'selected' : '';
						$presentationId = htmlentities($presentation->getId());
						$presentationTitle = htmlentities($presentation->getTitle());
					?>
                <option value="<?= $presentationId ?>" <?= $selectedAttribute ?>>
                    <?= $presentationTitle ?>
                </option>
				<?php endforeach;?>
				</select>
			</div>        
			
			<div class="form-group">
				<label for="title">Заглавие:</label>
				<input type="text" id="title" name="title" required>
			</div>
        
			<div class="form-group">
				<label for="author">Автор:</label>
				<input type="text" id="author" name="author" required>
			</div>
			
			<div class="form-group">
				<label for="author">Факултетен номер:</label>
				<input type="text" id="fn" name="fn" required>
			</div>
			
			<div class="form-group">
				<label for="date">Дата:</label>
				<input type="text" id="date" name="date" required>
			</div>
        
			<div class="form-group">
				<label for="hour">Час:</label>
				<input type="text" id="hour" name="hour" required>
			</div>
        
			<div class="form-group">
				<label for="room">Стая:</label>
				<input type="text" id="room" name="room" required>
			</div>
			
			<div class="form-group">
				<label for="author">Интерес:</label>
				<select id="interests" name="Interests">
				<option value="" selected>Изберете интерес</option>
				<option value="Мисля да отида">Мисля да отида</option>
				<option value="Интересно ми е">Интересно ми е</option>
				<option value="Може да е интересно">Може да е интересно</option>
				</select>
			</div>
			
			<input type="submit" value="Редактиране на презентация">
    </form>
	</div>

</body>

