<!DOCTYPE html>
<html lang="en">
<title>Relfinder</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.1/css/bulma.css">

<?php
ini_set('max_execution_time', 0);
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
?subject?pf1  <http://dbpedia.org/resource/".$object1.">
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
?subject?pf1  <http://dbpedia.org/resource/".$object2.">
FILTER ((?pf1 != rdf:type ) &&
(?pf1 != skos:subject ) &&
(?pf1 != <http://dbpedia.org/property/wikiPageUsesTemplate> ) &&
(?pf1 != <http://dbpedia.org/property/wordnet_type> )
)
}";


function type_and_same_type($name){
	return "PREFIX db: <http://dbpedia.org/resource/>
	PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
	PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
	SELECT ?subject
	WHERE {
	  ?subject dbo:type ?type.
	   <".$name."> dbo:type ?type

	}";
}


$arr = $r->getQueries($object1, $object2, $maxDistance, $limit, $ignoredObjects, $ignoredProperties, $avoidCycles);
//print_r($arr);
?>
<div class="container">
<?php
$results_arr = array();
foreach ($arr as $distance){
	foreach ($distance as $query){
		$now = microtime(true);
		echo "<pre>";
		echo "<xmp>".$query."</xmp>";
		echo $r->executeSparqlQuery($query, "HTML");
		$results_arr[] = $r->executeSparqlQuery($query);
		echo "<br>needed ".(microtime(true)-$now)." seconds<br>";
		echo "</pre>";
	}
}
$connectors = array();
$regexed_objects = array();
$objects = array();
foreach($results_arr as $result){
	//var_dump ($result);
	echo "<br>";
	if(preg_match('/"value"/',$result)){
		//echo "encontrei resultados ";
		//echo "<br>";
		preg_match('/"vars":\s\[(\S+\s?\S+)+\]/', $result, $connectors[]);

		if(preg_match('/"o[f|s]\w+"/',$result)){
	 		preg_match_all('/o\S+\s{\s\S+\s\S+\s\S+\s"(\S+)"/',$result, $regexed_objects[]);
		}

		if (preg_match('/"middle"/',$result)){
			preg_match_all('/middle\S+\s{\s\S+\s\S+\s\S+\s"(\S+)"/',$result, $regexed_objects[]);
		}



	}else{
		//echo "não encontrei resultados";
		//echo "<br>";
	}
}
foreach($regexed_objects as $object_name){
	foreach($object_name[1] as $name){
		$objects[$name] = $name;
	}
}
array_unique($objects);
echo "<pre>";
echo "Esses são todos os Objetos em todas as relações:";
echo "<br>";
var_dump($objects);
echo "</pre>";
echo "<br>";

echo "<br>";
echo "<hr>";
echo "<pre>";
echo "Tamanho das relações:";
echo "<br>";
echo "<br>";
$predicates = array();
foreach($connectors as $vars){
	preg_match_all('/(p\w+)+/',$vars[0], $predicates,PREG_PATTERN_ORDER);
	var_dump($vars[0]);
	echo("Tamanho: ");
	echo(count($predicates[1]));
	echo "<br>";
	echo "<br>";
}
echo "</pre>";
echo "<br>";

$objects["http://dbpedia.org/resource/Google"] = 0;
$objects["http://dbpedia.org/resource/Gmail"] = 0;

foreach($objects as $object=>$value){
	$totalrelationsobj1 = array();
	$subjects = array();
	$type_and_same_type_query = type_and_same_type($object);
	$totalrelationsobj1 = $r->executeSparqlQuery($type_and_same_type_query);
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
	    $all_relations_nome  = "PREFIX db: <http://dbpedia.org/resource/>
	        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
	        PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
	        SELECT ?subject SAMPLE(?pf1) WHERE {
	         ?subject ?pf1 <".$nome.">
	        FILTER ((?pf1 != rdf:type ) &&
	        (?pf1 != skos:subject ) &&
	        (?pf1 != <http://dbpedia.org/property/wikiPageUsesTemplate> ) &&
	        (?pf1 != <http://dbpedia.org/property/wordnet_type> ) &&
					(?pf1 != <http://dbpedia.org/ontology/wikiPageRedirects> )
	        )
	        }
	        GROUP BY ?subject";
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

?>
</div>
</html>
