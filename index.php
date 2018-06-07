<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Relfinder</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css">
</head>
<body>
  <nav class="navbar is-transparent" id="top">
    <div class="container">
      <div class="navbar-brand">
        <a class="navbar-item is-active" href="../index.html">
          Relfinder
				</a>
      </div>
    </div>
  </nav>
  <section class="section">
<?php
	ini_set('max_execution_time', 0);
	require_once('RelationFinder.php');
	require_once('Type.php');
	require_once('TypeQuery.php');
	require_once('AllRelations.php');
	require_once('AllObjects.php');
	require_once('RelationSize.php');
	require_once('Popularity.php');
	require_once('FileWriter.php');
	require_once('ClassQuery.php');
	require_once('Topic.php');


	$r = new RelationFinder();

	$object1 = "db:Google";
	$object2 = "db:Gmail";

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
			
?>
    


<?php
	$results_arr = array();
	$predicates = array();
	$exploded_result = array();
	$relation_size = 0;
	$totais = array();
	
	echo "<pre>";
	//$objects["http://dbpedia.org/resource/Google"] = 0;
	//$objects["http://dbpedia.org/resource/Gmail"] = 0;
	//$objects["http://dbpedia.org/resource/Google"] = 0;  409, 4315
	//$objects["http://dbpedia.org/resource/Gmail"] = 0;   7, 7
	//sameType($objects,$totais, $r);
	//unset($objects);

	
	foreach ($arr as $distance){
		foreach ($distance as $query){
			$regexed_objects = array();
			$objects = array();
			$connectors = array();
			$now = microtime(true);
            echo '<div class="container content"> <div class="columns is-multiline"> <div class="column">';

			echo "<xmp>".$query."</xmp>";
			echo $r->executeSparqlQuery($query, "HTML");
			$results = $r->executeSparqlQuery($query);
			echo"<br>";
			$exploded_result = explode("}}", $results);

			echo"</br>";
			echo "<br>needed ".(microtime(true)-$now)." seconds<br>";


			foreach($exploded_result as $result){

				

				
				$should_print = false;
				if(preg_match('/"value"/',$result)){
					$should_print = true;

					preg_match('/"vars":\s\[(\S+\s?\S+)+\]/', $result, $connectors[]);

					
					if(preg_match('/(?:"o[f|s]\w+"|middle)/',$result)){
				 		preg_match_all('/((?:o|middle)\S+\s{\s\S+\s\S+\s\S+\s"(\S+)" )/',$result, $regexed_objects[]);
					}
					
				}

				if($should_print){

					if(!empty($connectors)){
						$relation_size = relationSize($connectors);
					}

					if(!empty($regexed_objects)){
						allObjects(end($regexed_objects), $objects);
					}

					if(!empty($objects)){
						sameType($objects, $totais, $r);
						unset($objects);
					}
				}
			}
			echo"</div></div><hr></div>";
		}
	}

	echo '<pre>';
		var_dump($totais);
	echo '</pre>'; 

	parseFile($totais);

	$output = '';

	exec('python lda.py', $output);


	echo '<br>';
	echo '<pre>';
		var_dump($output);
	echo '</pre>'
?>

</section>
</body>
</html>
