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
<body onload="startNewGame()">
	<div class ="container">	
		<h1> Debiuty szachowe </h1>
		<h2> Trening zalogowanego użytkownika </h2>	
		<?php
			echo "Jesteś zalogowany jako ".$_SESSION['login']."<br/>";	
			/* GET DEBUT ID FROM choose_debut_Lin DROP DOWN LIST */
			$debut_data = explode("_", $_POST["debut_list"] );
			$debut_id = $debut_data[0];
			echo "Wybrany debiut: ".$debut_id."<br/>"; //MY TEST
			/* DATA BASE CONNECTION FOR DEBUT DATA NAD SEQUENCE LOAD */
			require_once("connect_to_DB.php");
			$connection = new mysqli($host, $db_user, $db_password, $db_name); /*@ PRZED new */
			/* INSTED OF or die($connection->error) which results no error handling */
			if($connection->connect_errno != 0) // CONNECTION CHECK
			{
				echo "Error".$connection->connect_errno."Opis: ".$connection->connect_error;	/* @? */				
			}
			else // CONNECTION SUCCESSFUL
			{
				$sql_command=sprintf("SELECT * FROM  debuts WHERE id='%s' ", mysqli_real_escape_string($connection, $debut_id));
				$result = $connection->query($sql_command);
				$row = $result->fetch_assoc();			
				echo $row['id']."<br/>";
				echo $row['name']."<br/>";
				echo $row['author']."<br/>";
				echo $row['sequence']."<br/>";
				/* CLEAR RAM FROM $result  */
				$result->free_result();
				$connection->close();
				
			}	
		?>
		<a href="log_out.php" class="menu_button"> Wyloguj </a>	
		<a href="logged_in_menu.php" class="menu_button"> Powrót do menu zalogowanego użytkownika </a>
		<div class = "chess_game_menu">
			<button onclick="startNewGame()"> RESET </button>
			<button onclick="rotateBoard()"> OBRÓĆ </button>
			<button onclick="takeBack()"> COFNIJ </button> 
		</div>
		In hand: <br/>
		<div id="hand"> </div><br/> <!-- JAVA SCRIPT EXECUTES HERE -->
		<div id="board"> </div> <!-- JAVA SCRIPT EXECUTES HERE -->	
		
	</div>
</body>
</html>