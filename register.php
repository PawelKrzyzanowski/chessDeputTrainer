<!DOCTYPE HTML>
<?php
	session_start();
?>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<title>Rejestracja</title>
		<meta name="description" content="Opis zawartości" />
		<meta name="keywords" content="moja, strona, opis, tytuł, zawartość" />
		<meta http-equiv="X-UA-Compatibile" content="IE=edge, chrome=1" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<style>
			.error{
			color: red;		margin-bottom: 10px;	maring-top: 10px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1> Debiuty szachowe </h1>
			<h2> ekran rejestracji </h2>
			<form action="register2.php" method="post">
				Login (od 3 do 20 znaków): <br/>
				<input type="text" name="login"><br/>
				<?php
					if(isset($_SESSION['ERROR_nick']))
					{
						echo '<div class="error">'.$_SESSION['ERROR_nick'].'</div>';
						unset($_SESSION['ERROR_nick']);	
					}
				?>
				<?php
					if(isset($_SESSION['ERROR_login_repetition']))
					{
						echo '<div class="error">'.$_SESSION['ERROR_login_repetition'].'</div>';
						unset($_SESSION['ERROR_login_repetition']);	
					}
				?>
				e-mail: <br/>
				<input type="text" name="mail"><br/>
				<?php
					if(isset($_SESSION['ERROR_mail']))
					{
						echo '<div class="error">'.$_SESSION['ERROR_mail'].'</div>';
						unset($_SESSION['ERROR_mail']);	
					}
					if(isset($_SESSION['ERROR_mail_length']))
					{
						echo '<div class="error">'.$_SESSION['ERROR_mail_length'].'</div>';
						unset($_SESSION['ERROR_mail_length']);		
					}
				?>
				
				hasło: <br/>
				<input type="password" name="password"><br/>
				powtórz hasło:<br/>
				<input type="password" name="repeated_password"><br/>
				<?php
					if(isset($_SESSION['ERROR_password']))
					{
						echo '<div class="error">'.$_SESSION['ERROR_password'].'</div>';
						unset($_SESSION['ERROR_password']);	
					}
				?>
				<label>
					<input type="checkbox" name="acceptance">Akceptuje regulamin<br/>
				</label> 
				<?php
					if(isset($_SESSION['ERROR_checkbox']))
					{
						echo '<div class="error">'.$_SESSION['ERROR_checkbox'].'</div>';
						unset($_SESSION['ERROR_checkbox']);	
					}
				?>
				<input type="submit" value="Rejestruj"/> <!-- register2.php SCRIPT WOKRS AFTER SUBMIT -->
			</form>
		</div>		
	</body>
</html>