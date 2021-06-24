<?php
	session_start();
	/* PREVENT FORM LOGGED USER */
	if((isset($_SESSION['logged_in_flag']))&&($_SESSION['logged_in_flag']==true))
	{
		echo "<script type='text/javascript'>alert('$I AM HERE');</script>";
		header('Location: logged_in_menu.php');
		exit();
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Debiuty szachowe</title>
	<meta name="description" content="Trenuj debiuty szachowe on-line. On-line chess debut trainer." />
	<meta name="keywords" content="chess, debut, trainer, on-line, otwarcia, szachowe, debiuty, trener, ćwieczenia, ptogram, do, otwarć, szachowych, debut practice" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge, chrome=1" />
	<link rel="stylesheet" href="chess.css" type="text/css"/>
	<style>
		.error{
		color: red;		margin-bottom: 10px;	maring-top: 10px;
		}
		.message{
		color: green;	margin-bottom: 10px;	maring-top: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1> Debiuty szachowe </h1>
		<h2> ekran logowania </h2>
		Kontynuuj bez zalogowania, aby ćwiczyć. <br/>
		Zaloguj się, aby tworzyć i edytować debiuty. <br/>
		<a href="train_logged_out.php"> Trening bez logowania  </a> <br/>
		<a href="register.php"> Rejestracja </a> <br/>
		<?php
			if(isset($_SESSION['MESSAGE_USER_ADDED']))
			{	
				echo '<div class="message">'.$_SESSION['MESSAGE_USER_ADDED'].'</div>';
				unset($_SESSION['MESSAGE_USER_ADDED']);				
			}
		?>
		<form action="log_in.php" method="post">
			Login: <input type="text" name="login" /> <br/>
			Hasło: <input type="password" name="password" /> <br/>
			<input type="submit" value="Zaloguj się" />
		</form>
		<?php
			if(isset($_SESSION['bad_login_error']))
			{	
				echo '<div class="error">'.$_SESSION['bad_login_error'].'</div>';
				unset($_SESSION['bad_login_error']);					
			}
		?>
		
	</div>
</body>
</html>