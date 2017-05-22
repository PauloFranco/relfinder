<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>REINS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="http://placehold.it/150x50&text=REINS" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>REINS</h1>
                <a href = "index.php?first=Angela_Merkel&second=Hillary_Rodham_Clinton"> Angela Merkel e Hillary Clinton</a><br>
                <a href = "index.php?first=Angela_Merkel&second=Joachim_Sauer"> Angela Merkel e seu marido</a><br>
                <a href = "index.php?first=Barack_Obama&second=Hillary_Clinton"> Barack Obama e Hillary Clinton</a><br>
                <form action = "index.php">
                first: <input type="text" width ="30" name = "first" value = "Google"><br>
                second: <input type="text" width ="30" name = "second" value = "Gmail"><br>

                <input type="submit">
                </form>

                <?php

                if(isset($_REQUEST['first']) && isset($_REQUEST['second'])) {

                	include('RelationFinder.php');
                	$first = 'http://dbpedia.org/resource/'.$_REQUEST['first'];
                	$second = 'http://dbpedia.org/resource/'.$_REQUEST['second'];

                	$rf = new RelationFinder();

                	$maxDistance = 4;
                  $limit = 10;
                  $ignoredObjects=null;
                  $ignoredProperties = array(
                  	'http://www.w3.org/1999/02/22-rdf-syntax-ns#type',
                  	'http://www.w3.org/2004/02/skos/core#subject',
                  	'http://dbpedia.org/property/wikiPageUsesTemplate',
                  	'http://dbpedia.org/property/wordnet_type'
                  	);
                  $avoidCycles = 2;
                	// get all queries we are interested in
                	$queries = $rf->getQueries($first, $second, $maxDistance, 10, array(), array('http://www.w3.org/1999/02/22-rdf-syntax-ns#type','http://www.w3.org/2004/02/skos/core#subject'), true);
                	//print_r($queries);
                	//exit();
                	// execute queries one by one
                	for($distance = 1; $distance <= $maxDistance; $distance++) {
                		echo '<b>Encontrando relacionamentos de distância '.$distance.'</b><br />';
                		foreach($queries[$distance] as $query) {

                			echo 'Executando a seguinte query:<br /><pre>'.htmlentities($query).'</pre><br/>';
                			$startTime = microtime(true);
                			$table = $rf->executeSparqlQuery($query, "HTML");

                			$runTime = microtime(true) - $startTime;
                			echo $table.'<br />';
                			echo 'runtime: '.$runTime.' seconds<br /><br />';
                		}
                	}

                }

                ?>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
