<?php
    function parseFile($dados){

        $file = fopen('teste.txt','w');

        foreach($dados as $dado){
            fwrite($file, $dado["distancia"].",");
            foreach($dado["topicos"] as $topico){
                fwrite($file, $topico[1].",");
            }
            fwrite($file, $dado["popularidade"].",".$dado["like"]."\n");
        }

        fclose($file);
    }

  
    
?>