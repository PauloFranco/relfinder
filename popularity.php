<?php
    function popularity($originais, $maiores, $quantidade_entidades){
        $sum = 0.0;

        $originais_values = array_values($originais);
        $maiores_values = array_values($maiores);


        for($i = 0; $i<sizeof($originais_values); $i++){
            $temp = $maiores_values[$i];

            if($originais_values[$i]==0 && $maiores_values[$i]==0){
                $temp = 0;
            }else if($maiores_values[$i] == 0) {
                $temp = $originais_values[$i];
            }

            if($temp != 0){
                $temp = $originais_values[$i]/$temp;
            }

            $sum = $sum + $temp;
        }

        $sum = (1/$quantidade_entidades) * $sum;

        return $sum;
    }
?>