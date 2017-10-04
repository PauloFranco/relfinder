<?php
	function allObjects($regexed_objects, &$objects){
		foreach($regexed_objects[1] as $name){
			$objects[$name] = $name;
		}

		array_unique($objects);
		echo "<br>Esses são todos os Objetos na relação:<br>";
		echo"<pre>";
		var_dump($objects);
		echo"</pre>";
		echo "<br>";
	}
?>
