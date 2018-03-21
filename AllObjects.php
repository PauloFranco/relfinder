<?php
	function allObjects($regexed_objects, &$objects){
		echo"<pre>";
		foreach($regexed_objects[1] as $name){
			$objects[$name] = $name;
			echo "<br>Esses são todos os Objetos na relação:<br>";
			
			echo("Google -- ".$name." -- Gmail");
			echo"<br>";
			echo"<br>";
			echo($name);
			echo "<br>";
		}
	}
?>
