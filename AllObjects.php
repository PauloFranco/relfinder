<?php
	function allObjects($regexed_objects, &$objects, &$all_objects){
		foreach($regexed_objects[1] as $name){
			$objects[$name] = $name;
			$all_objects[$name] = $name;
		}
	
		array_unique($objects);
		echo "<br>Esses são todos os Objetos na relação:<br>";
		var_dump($objects);
		echo "<br>";
	}
?>