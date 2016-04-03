<?php
	$elevandid= array( 
		array('nimi'=>'Kaa', 'vanus'=>9, 'kaal' => 4, 'pilt' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Asian_elephant_-_melbourne_zoo.jpg/800px-Asian_elephant_-_melbourne_zoo.jpg', 'tyyp'=> 'india elevant'), 
		array('nimi'=>'Tom', 'vanus'=>12, 'kaal' => 5.3, 'pilt' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/dc/Elephant_near_ndutu.jpg/1024px-Elephant_near_ndutu.jpg', 'tyyp' => 'aafrika elevant')
	);

	foreach ($elevandid as $elevant) {
		include("inkluud.html");
	}
?>