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

<?php

function cmp($a, $b)
{

    if($a["score"] == $b["score"]){
        return 0;
    }

    return $a["score"] > $b["score"]? -1:1;
}




$dados = array(


    array(
        "relacao" => "Batman - Wonder_Woman - Superman",
        "distancia"=>2, 
        "popularidade" => 0.3333333333333,
        "topicos" => [1.5,0,0.5,0,0],
        "like"    => 1,
        "x" => [2,0,0,0,0,0,0.33333333333333],
        "score" => 10.972101143333312
    ),





    array(
        "relacao" => "Batman - Category:American_comics_adapted_into_films - Superman",
        "distancia"=>2, 
        "popularidade" => 0.3333333333333,
        "topicos" => [0,0,0,0,0,0],
        "like"    => 0,
        "x" => [2,0.5,0,0,0.5,1,0.33333333333333],
        "score" => 7.188988438333311
    ),




    array(
        "relacao" => "Batman - Category:Comics_adapted_into_animated_series - Superman",
        "distancia"=>2, 
        "popularidade" => 0.3333333333333,
        "topicos" => [0,0,0,0,0,0],
        "like"    => 0,
        "x" => [2,0,0,0,1,1,0.33333333333333]
        ,"score" => 3.833080913333312
    ),



    array(
        "relacao" => "Batman - Wonder_Woman - Category:Superhero_film_characters - Superman",
        "distancia"=>3, 
        "popularidade" => 0.5,
        "topicos" => [0.33333333333333,0,1.3333333333333,0.33333333333333,0.33333333333333],
        "like"    => 1,
        "x" => [3,0.33333333333333,0,1.3333333333333,0.33333333333333,0.33333333333333,0.5],
        "score" => 6.399538148333541
    ),

    array(
        "relacao" => "Batman - Zatanna - Category:Superhero_television_characters - Superman",
        "distancia"=>3, 
        "popularidade" => 0.5,
        "topicos" => [1,0.33333333333333,0.33333333333333,0,0],
        "like"    => 0,
        "x" => [3,1,0.33333333333333,0.33333333333333,0,0,0.5],
        "score" => 16.101789444999987
    )





)

;
/*

2,0,0,0,0,0,0.33333333333333,1
2,0.5,0,0,0.5,1,0.33333333333333,0
2,0,0,0,1,1,0.33333333333333,0
3,0.33333333333333,0,1.3333333333333,0.33333333333333,0.33333333333333,0.5,1
3,1,0.33333333333333,0.33333333333333,0,0,0.5,0

*/



?>
<div class="container">
<table class="table is-bordered is-striped is-narrow is-hoverable">
<th>Relação</th>
<th>Like</th>
<th>Score</th>
<?php
for($i = 0; $i< sizeof($dados); $i++ ){
    echo"<tr>";
    echo"<td>";
    echo($dados[$i]["relacao"]);
    echo"</td>";
    echo"<td>";
    if($dados[$i]["like"] == 1){
        echo "sim";
    }else{
        echo"não";
    }
    echo"</td>";
    echo"<td>";
    echo("0");
    echo"</td>";
    echo "</tr>";
}

?>
</table>

<?php
usort($dados, "cmp");
?>


<table class="table is-bordered is-striped is-narrow is-hoverable ">
<th>Relação</th>
<th>Like</th>
<th>Score</th>
<?php
for($i = 0; $i< sizeof($dados); $i++ ){
    echo"<tr>";
    echo"<td>";
    echo($dados[$i]["relacao"]);
    echo"</td>";
    echo"<td>";
    if($dados[$i]["like"] == 1){
        echo "sim";
    }else{
        echo"não";
    }
    echo"</td>";
    echo"<td>";
    echo($dados[$i]["score"]);
    echo"</td>";
    echo "</tr>";
}

?>
</table>
</div>
<?php

$output = '';

exec('python lda.py', $output);

$output = $output[0].$output[1];

$output = str_replace("[","", $output);
$output = str_replace("]","", $output);

$valores = array();

preg_match_all('/(\S?\d+.\d+)e\+\d+/', $output, $valores);

$output = $valores[1];

echo '<pre>';
echo "w = ";
	var_dump($output);
echo '</pre>'


?>