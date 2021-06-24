<?php
	$debiut_id = 1;
	$RECORD_FLAG = false;
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
	<div id ="chess_game">
		
			<form action="index.php" method="post">
				Choose chess opening: 
				<br/>
				<select id="lista_otwarc" name="wybrany_debiut">
					<option selected value="1">1. Gambit Hemański</option>
					<option value="2">2. e4 Partia Hiszpańska (Ruy Lopez) - Obrona Morphy'ego </option>
					<option value="3">3. e4 Partia Angielska</option>
					<option value="4">4. e4 Obrona Sycylijska</option>
					<option value="5">5. e4 Obrona Caro-Kann</option>
					<option value="6">6. e4 Gambit Królewski - Gambit Skoczka</option>
					<option value="7">7. e4 Gambit Evansa</option>				
					<option value="8">8. Obrona Skandynawska</option>
					<option value="9">9. Obrona Królewsko-Indyjska</option>
					<option value="10">10. Obrona Hetmańsko-Indyjska</option>
					<option value="11">11. e4 Partia Włoska</option>
					<option value="12">12. Obrona Słowiańska</option>
					<br/>
					<input type="checkbox" id="RECORD_FLAG" name="RECORD_FLAG" value="true">
					<label for="check_rec">Nagrywanie</label>
					<input type="submit" value="Wybierz"/>
				</select>
			</form>	
		<br/>
		<?php
			try
			{
				$debiut_id = $_POST['wybrany_debiut'];
				if(isset($debiut_id))
				{
				echo('Wybrany debiut ID: '.$debiut_id.'<br/>');
				}
			}
			catch(Exception $e)
			{
				echo('Wybierz debiut');
			}
			try
			{
				$RECORD_FLAG = $_POST['RECORD_FLAG'];
				if(isset($RECORD_FLAG))
				{
				echo('Nagrywanie ruchów: '.$RECORD_FLAG.'<br/>');
				}
			}
			catch(Exception $e)
			{
				$RECORD_FLAG=false;
			}
		?>
		<br/>
		In hand: 
		<br/>
		<div id="hand"></div>
		<br/>
		<button onclick="startNewGame()"> New Game </button>
		<button onclick="rotateBoard()"> Rotate View</button>
		<button onclick="showNumbers()">Show Numbers</button>
		<br/>
		<div id="board">
		</div> <!--board-->
		
	</div> <!--chess_game-->
</body>
</html>

<!--
Partia Szkocka, obrona rosyjska,
https://www.youtube.com/watch?v=-n0y4WdE4l0

			
	
	
		<div class="nav">
			<ol>
				<li><a href="#"> Debiuty szachowe białe </a>
						<ul>
							<li><a href="#" onclick="chooseDebiut(0)"> Partia Włoska </a></li>
							<li><a href="#" onclick="chooseDebiut(1)"> Partia Hiszpańska </a></li>
							<li><a href="#" onclick="chooseDebiut(2)"> Partia Angielska </a></li>
						</ul>
				</li>
								<li><a href="#"> Debiuty szachowe czarne </a>
						<ul>
							<li><a href="#" onclick="chooseDebiut(3)"> Obrona Sycylijska </a></li>
							<li><a href="#" onclick="chooseDebiut(4)"> Obrona Caro-Kann </a></li>
							<li><a href="#" onclick="chooseDebiut(5)"> Obrona Słowiańska </a></li>
						</ul>
				</li>
			</ol>
		</div>