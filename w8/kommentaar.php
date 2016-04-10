<?php

	$bg_col="#fff"; // vaikimisi valge
	$col="#000"; // vaikimisi must
	$box_border="1px"; //vaikimisi 0
	$box_radius = "5px"; //vaikimisi 5
	$box_color= "#000";
	$sisu ="";

	if (isset($_POST['bg_col']) && $_POST['bg_col']!="") {
    	$bg_col=htmlspecialchars($_POST['bg_col']);
	}

	if (isset($_POST['col']) && $_POST['col']!="") {
    	$col=htmlspecialchars($_POST['col']);
	}

	if (isset($_POST['box_border']) && $_POST['box_border']!="") {
    	$box_border=htmlspecialchars($_POST['box_border']);
	}
	if (isset($_POST['box_radius']) && $_POST['box_radius']!="") {
    	$box_radius=htmlspecialchars($_POST['box_radius']);
	}
	if (isset($_POST['box_color']) && $_POST['box_color']!="") {
    	$box_color=htmlspecialchars($_POST['box_color']);
	}
	if (isset($_POST['sisu']) && $_POST['sisu']!="") {
    	$sisu=htmlspecialchars($_POST['sisu']);
	}

?>
<html>
<head>
	<title>Kommentaar</title>
	<style type="text/css">
		#main {
			margin: 0 auto;
			background: #f5f5f5;
			width: 50%;
		}
		textarea {
			margin: 0 auto;
			display: block;
			width: 100%;
			margin-bottom: 10px;
		}
		#box {
			border-style: solid;
			border-width: <?php echo $box_border; ?>;
			border-color: <?php echo $box_color; ?>;
			border-radius: <?php echo $box_radius; ?>;
			background: <?php echo $bg_col; ?>;
			color: <?php echo $col; ?>;
			min-height: 60px;
			margin-bottom: 20px;
			padding: 3px;
		}
		#container {
			margin: 0 auto;
			padding-top: 20px;
			width: 50%;
		}
		.inp_def {
			width: 40%;
			margin: auto;
		}
	
	</style>
</head>
<body>
	<div id="main">

	<div id="container">
		<div id="box"><?php echo $sisu; ?></div>
	<form action="kommentaar.php" method="POST">

		<textarea rows="4" cols="50" autofocus="autofocus" placeholder="Sisesta siia tekst" name="sisu" ></textarea>
		<div class="field">
			Tekstiv&auml;rvus:
			<input type="color" name="col" class="inp_def">
		</div>
		<div class="field">
			Taustav&auml;rvus:
			<input type="color" name="bg_col" class="inp_def">
		</div>
		<div class="field">
			Piirjoone laius:
			<input type="number" name="box_border" min="0" max="15">
		</div>
		<div class="field">
			Piirjoone nurga raadius:
			<input type="number" name="box_radius" min="0" max="50">
		</div>
		<div class="field">
			Piirjoone v&auml;rvus:
			<input type="color" name="box_color" >
		</div>
		<br />

		<input type="submit" name="submit" value="Salvesta">

	</form>
	</div>
</div>
</body>
</html>

<?php
?>