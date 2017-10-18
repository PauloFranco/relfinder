<?php
 function sameType(&$objects, $r){
 	foreach($objects as $object=>$value){
		$totalrelationsobj1 = array();
		$subjects = array();
		$totalrelationsobj1 = $r->executeSparqlQuery(sameTypeQuery($object));
		preg_match_all('/"(\S+\/\/\S+\/\S+)"/',$totalrelationsobj1, $subjects,PREG_PATTERN_ORDER);



		echo '<pre>';
		echo "Lista de sujeitos do mesmo tipo do ".$object." :";
		echo "<br>";
		echo "<br>";
		$relations = array();
		$maior = 0;
		$maior_nome = "";
		foreach ($subjects[1] as $nome){
		    $all_sizeone_relations = array();
		    $relations = array();
		    $all_relations_nome  = allRelations($nome);
		    $all_sizeone_relations = $r->executeSparqlQuery($all_relations_nome);
		    preg_match_all('/resource\/(\S+)"/',$all_sizeone_relations, $relations,PREG_PATTERN_ORDER);
		    echo $nome;
				echo "<br>";
			echo count($relations[1]);
		    echo "<br>";
			if(count($relations[1]) > $maior){
			    $maior = count($relations[1]);
			    $maior_nome = $nome;
		    }

		    var_dump($relations[1]);
		    echo "<br>";

		}
		echo "maior: ".$maior_nome." com ".$maior." relações";
		echo "<br>";
		echo "</pre>";
		echo "<br>";
	}

	unset($objects);
 }



?>