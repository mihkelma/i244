<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}


function kuva_puurid(){
	// siia on vaja funktsionaalsust
	global $connection;
	$p= mysqli_query($connection, "select distinct(puur) as puur from loomaaed order by puur asc");
	$puurid=array();
	while ($r=mysqli_fetch_assoc($p)){
		$l=mysqli_query($connection, "SELECT * FROM loomaaed WHERE  puur=".mysqli_real_escape_string($connection, $r['puur']));
		while ($row=mysqli_fetch_assoc($l)) {
			$puurid[$r['puur']][]=$row;
		}
	}
	include_once('views/puurid.html');
	
}

function logi(){
	// siia on vaja funktsionaalsust (13. nädalal)
	if (isset($_POST['user'])) {
		include_once('views/puurid.html');
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		  	$errors = array();
			//kontrolli POST vaartusi
		  	if (empty($_POST['user']) || empty($_POST['pass'])) {
		  		if(empty($_POST['user'])) {
			    	$errors[] = "Sisesta kasutajanimi";
				}
				if(empty($_POST['pass'])) {
					$errors[] = "Sisesta parool";
				} 
		  	} else {
				//kontrolli kasutaja olemasolu
		  		global $connection;
		  		$username = mysqli_real_escape_string($connection, $_POST["user"]);
		  		$passw = mysqli_real_escape_string($connection, $_POST["pass"]);
		  		
				$query = "SELECT id FROM mmatson_kylastajad WHERE username='$username' && passw=SHA1('$passw')";
				$result = mysqli_query($connection, $query) or die("Sisenemine eba&ouml;nnestus");
				//kui ridu on vahemalt 1, sisesta sessiooni kasutajanimi
				$ridu = mysqli_num_rows($result);
					if ( $ridu > 0) {
						$_SESSION['user'] = $username;
						header("Location: ?page=loomad");
					}
			}

	} else {
		include_once 'views/login.html';
	}
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function lisa(){
	// kontrolli, kas kasutaja on sisse loginud
	if (empty($_SESSION['user'])) {
		include_once 'views/login.html';
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = array();
  	
  		if(empty($_POST['nimi'])) {
	    	$errors[] = "Sisesta nimi";
		}
		if(empty($_POST['puur'])) {
			$errors[] = "Sisesta puur";
		}
		
		$pilt = upload("liik");
		if ($pilt == "") {
			$errors[] = "Vali pilt";
		}
	  	if (empty($errors)) {
	  		global $connection;
	  		$loomanimi = mysqli_real_escape_string($connection, $_POST["nimi"]);
	  		$puurinr = mysqli_real_escape_string($connection, $_POST["puur"]);
			$query = "INSERT INTO mmatson_loomaaed (nimi, liik, puur) VALUES ('$loomanimi', '$pilt', '$puurinr')";
			$result = mysqli_query($connection, $query) or die("&Uuml;leslaadimine eba&ouml;nnestus!");;
			
			//kui sisestus 6nnestus, suuna nimekirja vaatesse
			if (mysqli_insert_id($connection) > 0) {
				header("Location: ?page=loomad");
			}
	  	} 
	}
	include_once('views/loomavorm.html');
	
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

?>
