<?php

require_once('RelationFinder.php');


$r = new RelationFinder();
//$object1 = "db:Angela_Merkel";
//$object2 = "db:Joachim_Sauer";
$object1 = "db:Barack_Obama";
$object2 = "db:Hillary_Rodham_Clinton";
//$object2 = "db:Hillary_Rodham_Clinton";
//$object1 = "a";
//$object2 = "b";
$maxDistance = 3;
$limit = 10;
$ignoredObjects=null;
$ignoredProperties = array(
	'http://www.w3.org/1999/02/22-rdf-syntax-ns#type',
	'http://www.w3.org/2004/02/skos/core#subject',
	'http://dbpedia.org/property/wikiPageUsesTemplate',
	'http://dbpedia.org/property/wordnet_type'

	);
$avoidCycles = 2;

$arr = $r->getQueries($object1, $object2, $maxDistance, $limit, $ignoredObjects, $ignoredProperties, $avoidCycles);
//print_r($arr);
$results_arr = array();
foreach ($arr as $distance){
	foreach ($distance as $query){
		$now = microtime(true);
		echo "<xmp>".$query."</xmp>";
		echo $r->executeSparqlQuery($query, "HTML");
		$results_arr[] = $r->executeSparqlQuery($query);
		echo "<br>needed ".(microtime(true)-$now)." seconds<br>";
	}
	}
$regex = array();
foreach($results_arr as $result){
	var_dump ($result);
	echo "<br>";
	if(preg_match('/"value"/',$result)){
		echo "encontrei resultados ";
		echo "<br>";
		preg_match('/"vars":\s\[(\S+\s?\S+)+\]/', $result, $regex[]);
	}else{
		echo "não encontrei resultados";
		echo "<br>";
	}
}
echo "<br>";
echo "<br>";
$predicates = array();
foreach($regex as $vars){
	preg_match_all('/(p\w+)+/',$vars[0], $predicates,PREG_PATTERN_ORDER);
var_dump($vars);
echo "<br>";
echo("Tamanho: ");
echo(count($predicates[1]));
echo"<br>";
}
