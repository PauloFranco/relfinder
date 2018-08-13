<?php
function updateScores(&$totais, $output){
    $x = array();

    $score = '';
    $old_score = 0;

    foreach($totais as $total){
        $x = array();
        $score = '';
        $old_score = $total["score"];
        $x[] = $total["distancia"];
        foreach($total["topicos"] as $topico){
            $x[] =$topico[1];
        }
        $x[] = $total["popularidade"];
        $x[] = $total["like"];

        $command = "python matmul.py ".json_encode($x)." ".json_encode($output);


        exec($command, $score);    
        var_dump($x);
        var_dump($score);
        echo "<br>";
    }
}


?>