<?php
	function allObjects($regexed_objects, &$objects){
		echo"<pre>";
		$lista = "";

		foreach($regexed_objects[1] as $name){
			$lista = $lista." -- ".$name;
		}

		echo "<br>Esses são todos os Objetos na relação Google ".$lista." -- Gmail:<br>";
		echo"<br>";
		foreach($regexed_objects[1] as $index=>$name){
			$objects[$name] = $name;
			$index = $index +1;
			echo($index." - ".$name);
			echo "<br>";
			echo "<br>";
		}
	}
?>
