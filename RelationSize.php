<?php
	function relationSize($connectors){
		echo "<br><hr><pre>Tamanho das relações:<br><br>";

		foreach($connectors as $vars){
			preg_match_all('/(p\w+)+/',$vars[0], $predicates,PREG_PATTERN_ORDER);
			//var_dump($vars[0]);
			echo("Tamanho: ");
			echo(count($predicates[1]));
			echo "<br>";
			echo "<br>";
		}
		echo "</pre>";
		echo "<br>";
	}
?>