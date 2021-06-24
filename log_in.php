<?php
	session_start();	/* ENABLE OF $_SESSION[] GLOBAL ASSOCATIONAL ARRAY */
	require_once "connect_to_DB.php";
	/* PREVENT FROM UNLOGGED ACCESS*/
	if((!isset($_POST['login']))||(!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	/* CONNECT */
	$connection = new mysqli($host, $db_user, $db_password, $db_name); /*@ PRZED new */
	/* CONNECTION CHECK */
	if($connection->connect_errno != 0) 
	{
		echo "Error".$connection->connect_errno."Opis: ".$connection->connect_error;	/* @? */
	}
	else
	{
		/* CONECTION OPEN */
		$login = $_POST['login'];
		$password = $_POST['password'];
		/* LOGIN AND PASSWORD SANITIZATION */
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
		
		echo "</br> MY_TEST: login = ".$login."</br>password = ".$password."</br>";
		
		/* $sql_command = "SELECT * FROM users WHERE Login = '$login' AND Pasword = '$password'"; */
		/* PREVENT FROM SQL INJECTION */
		$sql_command=sprintf("SELECT * FROM  users WHERE login='%s' AND pasword='%s'", mysqli_real_escape_string($connection, $login), mysqli_real_escape_string($connection, $password)); 
		$result = $connection->query($sql_command);
		/* SQL COMMAND SYNTAX CHECK */
		
		if($result)
		{
			$number_of_rows = $result->num_rows;
			/* LOGGED IN CHECK TEST */
			if($number_of_rows>0)
			{
				/* LOGGED IN SUCCESSFULLY, USER FOUND ID DB */
				$_SESSION['logged_in_flag']=true;
				if(isset($_SESSION['bad_login_error']))
				{
					unset($SESSION['bad_login_error']);
				}
				/* SAVE DATA FROM ROW TO FETCH-ASSOCATION ARRAY */
				$data = $result->fetch_assoc();
				/* CLEAR RAM FROM $result  */
				$result->free_result();
				echo"<br/> MY_TEST: data[login] = ".$data['login'];
				$_SESSION['login'] = $data['login'];
				header('Location: logged_in_menu.php');
				/* STOP EXECUTING SCRIPT */
				exit();
			}
			else
			{
				echo "</br> MY_TEST: Użytkownika o tym loginie i haśle nie ma w bazie.";
				$_SESSION['bad_login_error']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				/* STOP EXECUTING SCRIPT */
				exit();
			}
		}
		else
		{
			echo "</br> SQL COMMAND SYNTAX ERROR ";
		}
		$connection->close();
	}
?>