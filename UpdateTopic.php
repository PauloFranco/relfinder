<?php
    function updateTopic($topics, &$totais){

        foreach($topics as $topic=>$value){
            foreach($totais as &$total){
                if(empty($total["topicos"][$topic])){
                    $total["topicos"][$topic] = [0,0.0];
                }
            }
        }

        foreach($totais as &$total){
            ksort($total["topicos"]);
        }
    }
?>