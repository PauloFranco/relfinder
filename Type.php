<?php
 function sameType(&$objects, &$totais, $r){
	$arestas_obj1 = 0;
	$maior = 0;
	$maiores = array();
	$originais = array();
	$classes = array();
	$classes_count = array();
	$indexes = "";

	$vetor = array();

 	foreach($objects as $object=>$value){
		if(!empty($indexes)){
			$indexes = $indexes." - ".$object;
		}else{
			$indexes = $object;
		}
		$totalrelationsobj1 = array();
		$subjects = array();
		$relations_obj1 = array();

		$all_relations_obj1 = allRelations($object);
		$all_sizeone_relations_obj1 = $r->executeSparqlQuery($all_relations_obj1);


		$query_classes = classQuery($object);

		$query_classes_result = $r->executeSparqlQuery($query_classes);


		preg_match_all('/ontology\/(\S+)"/',$query_classes_result, $classes,PREG_PATTERN_ORDER);

		foreach($classes[1] as $classe){
			if(empty($classes_count[$classe])){
				$classes_count[$classe] = array();
				$classes_count[$classe] = [1,0];
			}else{
				$classes_count[$classe] =[($classes_count[$classe][0] + 1),0];
			}
			
		}

		preg_match_all('/resource\/(\S+)"/',$all_sizeone_relations_obj1, $relations_obj1,PREG_PATTERN_ORDER);
		$totalrelationsobj1 = $r->executeSparqlQuery(sameTypeQuery($object));
		preg_match_all('/"(\S+\/\/\S+\/\S+)"/',$totalrelationsobj1, $subjects,PREG_PATTERN_ORDER);
		$arestas_obj1 = count($relations_obj1[1]);
		echo $object;
		echo "<br>";
		echo $arestas_obj1;
		echo "<br>";
		echo "<br>";
		echo "Lista de sujeitos do mesmo tipo do ".$object." :";
		echo "<br>";
		echo "<br>";
		$relations = array();
		$maior = $arestas_obj1;
		$original = $arestas_obj1;
		$originais[] = $original;
		$maior_nome = $object;
			
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

		$maiores[] = $maior;


		if(!empty($relations)){
			
			echo "maior: ".$maior_nome." com ".$maior." relações";
			echo "<br>";
		}
		else{
			echo "Não foram encontrados objetos do mesmo tipo";
			echo "<br>";
		}
		echo "<br>";
	}
	echo "</pre>";


	$vetor[] = $indexes;

	topicFeatures($classes_count, count($objects)+1);
	
	$totais[$indexes] = [count($objects)+1, $originais, $maiores, $classes_count];
	
	
	unset($objects);
 }
?>