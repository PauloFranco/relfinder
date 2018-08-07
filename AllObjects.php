<?php
	function allObjects($regexed_objects, &$objects){
		//echo"<pre>";
		$lista = "";

		foreach(end($regexed_objects) as $name){
			$lista = $lista." -- ".$name;
		}

		//echo "<br>Esses são todos os Objetos na relação Google ".$lista." -- Gmail:<br>";
		//echo"<br>";
		foreach(end($regexed_objects) as $index=>$name){
			$objects[$name] = $name;
			$index = $index +1;
			//echo($index." - ".$name);
			//echo "<br>";
			//echo "<br>";
		}
	}
?>
