<?php
	session_start();
	/* JSON DECODE FOR SAVING DATA IN PHP VARIABLE */
	/* CLEAR STRING , WILL BE SAVED IN DB*/
	$name = "";
	$author = "";
	$sequence_string = "";
	$debut_data = new stdClass;
	$debut_data = json_decode($_POST['debut_data']);
	$name = $debut_data->name;
	/* $author = $debut_data->author; */
	$author = $_SESSION['login'];
	$size = count($debut_data->sequence);
	for($i=0; $i<$size; $i++)
	{
		$sequence_string .= $debut_data->sequence[$i];
		$sequence_string .= ",";
	}
	/* SAVING DATA TO DB */
	require_once("connect_to_DB.php");
	mysqli_report(MYSQLI_REPORT_STRICT);
	try
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name); /*DO UZUPEŁNIENIA: @ PRZED new */
		// CONNECTION FAUILURE
		if($connection->connect_errno!=0)
		{
			//echo "Error: ".$connection->connect_errno."<br/> Opis: ".$connection->connect_error;
			throw new Excpetion(mysqli_connect_errno());
		}
		// SUCCESFULL CONNECTION 
		else
		{
			$prepared_statement = $connection->prepare("INSERT INTO debuts (name, login, sequence) VALUES (?, ?, ?)");
			if($prepared_statement == false)
			{
				echo "prepare() returns FALSE <br/>";		// DO UZUPEŁNIENIA : CZY TRY CATCH MOŻNA STOSOWAĆ DO FALSE ???
			}
			else
			{
					$prepared_statement->bind_param("sss", $name, $author, $sequence_string);
					$prepared_statement->execute();
					$_SESSION['MESSAGE_DEBUT_ADDED']="Debiut został dodany poprawnie.";
			}
		}
		$connection->close();
	}
	catch(Excpetion $e)
	{
		echo '<span style="color:red;">Błąd serwera! Nie można teraz zapisać debutu, sprobój później./span><br/>';
		echo '$e<br/>';
	}
?>

