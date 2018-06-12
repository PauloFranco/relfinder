<?php
   


    function parseFile($dados){
        $file = fopen('teste.txt','w');

        foreach($dados as $dado){
            fwrite($file, $dado["distancia"].",");
            foreach($dado["topicos"] as $topico){
                fwrite($file, $topico[1].",");
            }
            fwrite($file, $dado["popularidade"].",".rand(0,1)."\n");
        }

        fclose($file);
    }

  
    
?>