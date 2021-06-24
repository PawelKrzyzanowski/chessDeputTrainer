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
		<h2> Trening zalogowanego użytkownika </h2>	
		<?php
			echo "Jesteś zalogowany jako ".$_SESSION['login']."<br/>";
		?>
		<div id = "logged_menu" class = "menu_bar">
			<a href="log_out.php" class="menu_button"> Wyloguj </a>	
			<!-- DATA BASE CONNECTION FOR INTERACTIVE SELECT-OPTION LIST -->
			<?php
				require_once("connect_to_DB.php");
				$connection = new mysqli($host, $db_user, $db_password, $db_name); /*@ PRZED new */
				/* INSTED OF or die($connection->error) which results no error handling */
				if($connection->connect_errno != 0) // CONNECTION CHECK
				{
					echo "Error".$connection->connect_errno."Opis: ".$connection->connect_error;	/* @? */				
				}
				else // CONNECTION SUCCESSFUL
				{
					$result = $connection->query("SELECT id, name, author FROM debuts ORDER BY name");
					$connection->close();
				}
			?>
			Wybierz debiut:
			<form method="post" action="train_Lin.php">
				<select name="debut_list">
					<?php 
						while($row = mysqli_fetch_array($result))
						{						
							echo "<option value =".$row['id'].">".$row['name']." autor: ".$row['author']."</option>";
						}
					?>
				</select>
				<input type="submit" value="Wybierz"/>
			</form>
		</div>
	</div>
</body>
</html>