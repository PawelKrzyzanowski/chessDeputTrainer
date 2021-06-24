<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Mój tytuł!</title>
	<meta name="description" content="Opis zawartości" />
	<meta name="keywords" content="moja, strona, opis, tytuł, zawartość" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge, chrome=1" />
	<!--<link rel="stylesheet" href="style.css" type="text/css"/>-->
	<script type="text/javascript" src="jquery-3.5.1.js"> </script>
</head>
<body>
	<?php
		$emp = ["id" => 1, "name" => "Pawel", "addr" => "Pruszkow"];
		$json = json_encode($emp);
	?>
</body>
<script type="text/javascrpit">
	var emp = <?= $json?>;
	console.log(emp);
</script>
</html>
