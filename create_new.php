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
	<title>Debiuty szachowe</title>
	<meta name="description" content="Trenuj debiuty szachowe on-line. On-line chess debut trainer." />
	<meta name="keywords" content="chess, debut, trainer, on-line, otwarcia, szachowe, debiuty, trener, ćwieczenia, program, do, otwarć, szachowych, debut, practice" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge, chrome=1" />
	<link rel="stylesheet" href="chess.css" type="text/css"/>
	<style>
			.message{
			color: green;	margin-bottom: 10px;	maring-top: 10px;
			}
	</style>
	<script type="text/javascript" src="jquery-3.5.1.js"></script>
	<script src="chess.js"></script>
</head>
<body onload = "startNewGame()">
	<div class="container">
		<h1> Debiuty szachowe </h1>
		<h2> ekran tworzenia nowego debiutu </h2>
		<?php
		echo "Jesteś zalogowany jako ".$_SESSION['login']."<br/>";
		/* CONVERT PHP login ITNO JSON REPRESENTATION FOR saveNewSequence FUNCTION IN chess.js */
			$login_JSON = json_encode($_SESSION['login']);
		?>
		<a href="log_out.php" class="menu_button"> Wyloguj </a>	
		<a href="logged_in_menu.php" class="menu_button"> Powrót do menu zalogowanego użytkownika </a>	
		<div class = "chess_game_menu" >
			<button onclick="startNewGame()"> RESET </button>
			<button onclick="rotateBoard()"> OBRÓĆ </button>
			<button onclick="takeBack()"> COFNIJ </button> 
			<button onclick="saveNewSequence()"> ZAPISZ SEKWENCJĘ </button> <br/>
		</div>
		<?php
			if(isset($_SESSION['MESSAGE_DEBUT_ADDED']))
			{
				echo '<div class="message">'.$_SESSION['MESSAGE_DEBUT_ADDED'].'</div>';
				unset($_SESSION['MESSAGE_DEBUT_ADDED']);
			}
		?>
		In hand: <br/>
		<div id="hand"> </div><br/> <!-- JAVA SCRIPT EXECUTES HERE -->
		
		<div id="board"> </div> <!-- JAVA SCRIPT EXECUTES HERE -->		
	</div>
</body>
</html>