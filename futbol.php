<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Rozgrywki futbolowe</title>
</head>
<body>
	<div id="baner">
		<h2>Światowe rozgrywki piłkarskie</h2>
		<img src="img/obraz1.jpg" alt="boisko">
	</div>

	<div id="matches">
		<?php
			require_once 'connection.php';

			$connection = @new mysqli($host, $db_user, $db_password, $db_name);

			if ($connection -> connect_errno != 0) {
				echo 'Blad polaczenia z baza danych';
				exit();
			}

			$result = $connection -> query('SELECT * FROM rozgrywka');

			while($row = mysqli_fetch_assoc($result)) {
				echo '<section>';
				echo '<h3>' . $row['zespol1'] . ' - ' . $row['zespol2'] .'</h3>';
				echo '<h4>' . $row['wynik'] . '</h4>';
				echo '<p>w dniu: ' . $row['data_rozgrywki'] . '</p>';
				echo '</section>';
			}
			$connection -> close();
		?>
	</div>

	<div id="main">
		<h2>Reprezentacja Polski</h2>
	</div>

	<div id="left">
		<p>Podaj pozycję zawodników (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-napastnicy)</p>
		<form method="POST">
			<input type="number" name="editionField">
			<input type="submit" name="editionButton" value="Sprawdź">
		</form>

		<ul>
			<?php
				require_once 'connection.php';

				if (!empty($_POST['editionField'])) {
					$playerPosition = $_POST['editionField'];
					$connection = @new mysqli($host, $db_user, $db_password, $db_name);
					$result = $connection -> query("SELECT * FROM zawodnik WHERE pozycja_id LIKE $playerPosition");
					
					while($row = mysqli_fetch_assoc($result)) {
						echo '<li>' . $row['imie'] . ' ' . $row['nazwisko'] . '</li>';
					}
					$connection -> close();
				}

			?>
		</ul>
	</div>

	<div id="right">
		<img src="img/zad1.png" alt="piłkarz">
		<p>Autor: Seweryn</p>
	</div>

</body>
</html>