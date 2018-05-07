<?php
	function relationSize($connectors){
		echo "<br>Tamanho da relação: ";
		preg_match_all('/(p\w+)+/',$connectors[0][0], $predicates,PREG_PATTERN_ORDER);
		echo(count($predicates[1]));
		echo "</pre>";
		echo "<br>";

		return count($predicates[1]);
	}
?>