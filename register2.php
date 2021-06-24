<?php
	// PHP SCRIPT STARTS AFTER SUBMIT
	session_start();
	// VALIDATION CHECK
	if(isset($_POST['mail']))
	{
		$positive_validation = true;
		// LOAD VARIABLES
		$login = $_POST['login'];
		$mail = $_POST['mail'];
		$password = $_POST['password'];
		$repeated_password = $_POST['repeated_password'];
		$acceptance = $_POST['acceptance'];
		// NICKNAME VALIDATION
		// length
		if(strlen($login)<3||strlen($login)>20)
		{			
			$positive_validation = false;
			$_SESSION['ERROR_nick']="Nick (login) musi posiadać od 3 do 20 znaków.";
		}
		// alfanumerical chars
		if(ctype_alnum($login)==false)
		{
			$positive_validation = false;
			$_SESSION['ERROR_nick']="Znaki muszą być alfanumeryczne, bez polskich znaków.";
		}
		// MAIL SANITIZATION
		$sanitated_mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
		// MAIL VALIDATION
		if((filter_var($sanitated_mail, FILTER_VALIDATE_EMAIL)==false)||($mail!= $sanitated_mail))
		{
			$positive_validation = false;
			$_SESSION['ERROR_mail']="Podaj poprawny adres e-mail.";
		}
		if(strlen($mail)<3||strlen($mail)>100)
		{			
			$positive_validation = false;
			$_SESSION['ERROR_mail_length']="Mail musi posiadać do 100 znaków.";
		}
		// PASSWORD VALIDATION
		// repeated password is the same
		if($password!=$repeated_password)
		{			
			$positive_validation = false;
			$_SESSION['ERROR_password']="Podane hasła nie są identyczne.";
		}
		// CHCECKBOX CHECK
		if(!isset($acceptance)){
			$positive_validation = false;
			$_SESSION['ERROR_checkbox']="Potwierdź akceptację regulaminu.";
		}
		// VALIDATION FAILURE
		if(!$positive_validation)
		{
			header('Location: register.php');
			exit();
		}
		// VALIDATION SUCCESSFULL
		// NO LOGIN REPETITION IN DATABASE
		require_once("connect_to_DB.php");
		mysqli_report(MYSQLI_REPORT_STRICT);	/* THROW my_sql_exception FOR ERRORS INSTEAD OF WARNINGS */
		/* mysqli_report(MYSQLI_REPORT_ALL);	// The must be ALL (not STRICT) to show prepare() error problem description ! on the other hand ALL creates to many errors */
		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name); /*DO UZUPEŁNIENIA: @ PRZED new */
			// CONNECTION FAUILURE
			if($connection->connect_errno!=0)
			{
				//echo "Error: ".$connection->connect_errno."<br/> Opis: ".$connection->connect_error;
				throw new Excpetion(mysqli_connect_errno());
			}
			// SUCCESSFUL CONNECTION 
			else
			{
				//USER LOGIN REPETITION CHECK:
				$sql_command=sprintf("SELECT * FROM  users WHERE login='%s' ", mysqli_real_escape_string($connection, $login)); 
				$result = $connection->query($sql_command);
				//ADDING PLAYER TO DATABASE
				if($result) //SUCCESSFUL QUERY
				{
					$number_of_rows = $result->num_rows;
					/* LOGGED IN CHECK TEST */
					if($number_of_rows<=0) // NO LOGIN REPETITION
					{
						/* $sql_command="INSERT INTO users (Name, Surname, Login, Pasword) VALUES (?, ?, ?, ?))"; */
						/* PREPARE-BIND-EXECUTE METHOD FOR SQL-INJECTION SEQURITY  */
						$prepared_statement = $connection->prepare("INSERT INTO users (login, mail, pasword, score) VALUES (?, ?, ?, 0)");
						/* THERE WAS ERROR: Fatal error: Uncaught Error: Call to a member function bind_param() on boolean (...) */
						/* SOLUTION: prepare() can return 'false', there is need to check if 'false' is returned and why */
						if($prepared_statement == false)
						{
							echo "prepare() returns FALSE <br/>";		// DO UZUPEŁNIENIA : CZY TRY CATCH MOŻNA STOSOWAĆ DO FALSE ???
						}
						else
						{
							$prepared_statement->bind_param("sss", $login, $mail, $password);
							$prepared_statement->execute();
							$_SESSION['MESSAGE_USER_ADDED']="Użytkownik dodany poprawnie.";
							header('Location: index.php');
							exit();
						}
					}
					else // LOGIN REPETITION
					{
						$_SESSION['ERROR_login_repetition']="Taki użytkownik występuje już w bazie.";
						header('Location: register.php');
						exit();
					}
				}
				$connection->close();
			}	
		}
		catch(Excpetion $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span><br/>';
			echo '$e<br/>';
		}
	}
?>