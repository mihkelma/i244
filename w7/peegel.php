<?php
	$tekst = "Selle teksti keerame teistpidi erinevate meetodite abil.";
	echo $tekst."<br>";
	//echo tagurpidi($tekst);
	echo "Variant 1 (substr ja liitmine): ".tagurda($tekst)."<br>";
	echo "Variant 2 (array): ".tagurda2($tekst)."<br>";


	function tagurda2($sisend) {
		$ajutine = "";
		$len = strlen($sisend);
		for (($i=$len-1); $i >= 0; $i--) {
			//echo $sisend[$i];
			$ajutine .= $sisend[$i];
		}
		return $ajutine;
	}

	function tagurda($sisend) {
		$ajutine = "";
		$len = strlen($sisend);
		for ($i=0; $i <= $len ; $i++) { 
 			$ajutine .= substr($sisend,$len-$i,1);
		}
		//echo $ajutine;
		return $ajutine;
	}

	// saa teksti pikkus
	// tsükkel -võta viimane täht, lahuta 1 pikkusest
?>
