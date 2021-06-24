<?php
	session_start();
	/* PREVENT FROM UNLOGGED */
	if(!isset($_SESSION['logged_in_flag']))
	{
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Chess</title>
	<meta name="description" content="Chess" />
	<meta name="keywords" content="chess" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge, chrome=1" />
	<link rel="stylesheet" href="chess.css" type="text/css"/>
	<script src="chess.js"></script>
</head>
<body>
	<div class ="container">	
		<h1> Debiuty szachowe </h1>
		<h2> Menu zalogowanego użytkownika </h2>	
		<?php
		echo "Jesteś zalogowany jako ".$_SESSION['login']."<br/>";
		?>
		Wybierz co chcesz zrobić:<br/>
		<div id = "logged_menu" class = "menu_bar">
			<a href="choose_debut_Lin.php" class="menu_button"> Trenuj jako zalogowany użtkownik. </a>
			<a href="create_new.php" class="menu_button"> Utwórz nowy debiut. </a>
			<a href="edit_debut.php" class="menu_button"> Otwórz zapisany debiut. </a>
			<a href="log_out.php" class="menu_button"> Wyloguj </a>
		</div>
	</div>
</body>
</html>