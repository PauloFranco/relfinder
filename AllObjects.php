<?php
	function allObjects($regexed_objects, &$objects){
		echo"<pre>";
		$lista = "";

		foreach($regexed_objects[1] as $name){
			$lista = $lista." -- ".$name;
		}

		echo "<br>Esses são todos os Objetos na relação Google ".$lista." -- Gmail:<br>";
		foreach($regexed_objects[1] as $name){
			$objects[$name] = $name;
			
			echo"<br>";
			echo"<br>";
			echo($name);
			echo "<br>";
		}
	}
?>
