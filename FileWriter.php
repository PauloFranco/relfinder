<?php
   


    function parseFile($dados){
        $file = fopen('teste.txt','w');

        foreach($dados as $dado){
            fwrite($file, $dado["distancia"].",".$dado["popularidade"].",".rand(0,1)."\n");
        }

        fclose($file);
    }

  
    
?>