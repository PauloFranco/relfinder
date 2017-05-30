<?php

require_once('RelationFinder.php');


$r = new RelationFinder();
//$object1 = "db:Angela_Merkel";
//$object2 = "db:Joachim_Sauer";
$object1 = "db:Google";
$object2 = "db:Gmail";
//$object2 = "db:Hillary_Rodham_Clinton";
//$object1 = "a";
//$object2 = "b";
$maxDistance = 2;
$limit = 10;
$ignoredObjects=null;
$ignoredProperties = array(
	'http://www.w3.org/1999/02/22-rdf-syntax-ns#type',
	'http://www.w3.org/2004/02/skos/core#subject',
	'http://dbpedia.org/property/wikiPageUsesTemplate',
	'http://dbpedia.org/property/wordnet_type'

	);
$avoidCycles = 2;

$allrelations_object1 = "PREFIX db: <http://dbpedia.org/resource/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
SELECT * WHERE {
?subject?pf1  ".$object1."
FILTER ((?pf1 != rdf:type ) &&
(?pf1 != skos:subject ) &&
(?pf1 != <http://dbpedia.org/property/wikiPageUsesTemplate> ) &&
(?pf1 != <http://dbpedia.org/property/wordnet_type> )
)
}";

$allrelations_object2  = "PREFIX db: <http://dbpedia.org/resource/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
SELECT * WHERE {
?subject?pf1  ".$object2."
FILTER ((?pf1 != rdf:type ) &&
(?pf1 != skos:subject ) &&
(?pf1 != <http://dbpedia.org/property/wikiPageUsesTemplate> ) &&
(?pf1 != <http://dbpedia.org/property/wordnet_type> )
)
}";

$type_and_same_type ="PREFIX db: <http://dbpedia.org/resource/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
SELECT ?subject
WHERE {
  ?subject dbo:type ?type.
   db:Google dbo:type ?type

}";

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
echo "<br>";

$totalrelationsobj1 = array();
$subjects = array();
$totalrelationsobj1 = $r->executeSparqlQuery($type_and_same_type);
preg_match_all('/resource\/(\S+)"/',$totalrelationsobj1, $subjects,PREG_PATTERN_ORDER);
echo "Lista de sujeitos do mesmo tipo do Gmail:";
echo "<br>";
foreach ($subjects[1] as $nome){
	echo $nome;
	echo "<br>";
}
