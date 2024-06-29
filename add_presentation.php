<body>
	<header>
        <h1 class="logo">Добавяне на презентация</h1>
        <nav class="clear right">
            <a href="./handle_requests.php?target=user&action=logout" id="logout-link">Отписване</a>
        </nav>
    </header>
    <div class="container">
        <h2>Добавяне на нова презентация</h2>
		
        <form method="post" action="./handle_requests.php?target=admin&action=addPresentation">
		
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
			
            <input type="submit" value="Добавяне на презентация">
        </form>
    </div>	
</body>

