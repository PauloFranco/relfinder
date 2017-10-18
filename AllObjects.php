<?php
	function allObjects($regexed_objects, &$objects){
		foreach($regexed_objects[1] as $name){
			$objects[$name] = $name;
			echo "<br>Esses são todos os Objetos na relação:<br>";
			echo"<pre>";
			echo("Google -- ".$name." -- Gmail");
			echo"<br>";
			echo"<br>";
			echo($name);
			echo "<br>";
		}
	}
?>
