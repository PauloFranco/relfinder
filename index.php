<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Relfinder</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.1/css/bulma.css">
</head>
<body>
  <nav class="nav has-shadow" id="top">
    <div class="container">
      <div class="nav-left">
        <a class="nav-item" href="../index.html">
          <img src="../images/bulma.png" alt="Relfinder">
        </a>
      </div>
      <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
      </span>
      <div class="nav-right nav-menu">
        <a class="nav-item is-tab is-active">
          Home
        </a>
        <a class="nav-item is-tab">
          Features
        </a>
        <a class="nav-item is-tab">
          Team
        </a>
        <a class="nav-item is-tab">
          Help
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


	$r = new RelationFinder();

	$object1 = "db:Google";
	$object2 = "db:Gmail";

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

	$arr = $r->getQueries($object1, $object2, $maxDistance, $limit, $ignoredObjects, $ignoredProperties, $avoidCycles);
	//print_r($arr);
?>
    <div class="container content">


<?php
	$results_arr = array();
	$predicates = array();

	foreach ($arr as $distance){
		foreach ($distance as $query){
			$regexed_objects = array();
			$objects = array();
			$connectors = array();
			$now = microtime(true);
            echo '<div class="columns is-multiline"> <div class="column">';
		//	echo "<pre>";
			echo "<xmp>".$query."</xmp>";
			echo $r->executeSparqlQuery($query, "HTML");
			$result = $r->executeSparqlQuery($query);
			echo "<br>needed ".(microtime(true)-$now)." seconds<br>";

			if(preg_match('/"value"/',$result)){
				preg_match('/"vars":\s\[(\S+\s?\S+)+\]/', $result, $connectors[]);

				if(preg_match('/"o[f|s]\w+"/',$result)){
			 		preg_match_all('/o\S+\s{\s\S+\s\S+\s\S+\s"(\S+)"/',$result, $regexed_objects[]);
				}

				if (preg_match('/"middle"/',$result)){
					preg_match_all('/middle\S+\s{\s\S+\s\S+\s\S+\s"(\S+)"/',$result, $regexed_objects[]);
				}
			}

			if(!empty($regexed_objects)){
				allObjects(end($regexed_objects), $objects);
			}

			if(!empty($connectors)){
				relationSize($connectors);
			}


			if(!empty($objects)){
				//$objects["http://dbpedia.org/resource/Google"] = 0;
				$objects["http://dbpedia.org/resource/Gmail"] = 0;
				sameType($objects, $r);
				unset($objects);
			}
			//echo "</pre>";
            echo '</div></div>';
		}
	}
?>
	</div>
</section>
</body>
</html>
