<?php
    function updateWeights($output){
        $output = $output[0].$output[1];

        $output = str_replace("[","", $output);
        $output = str_replace("]","", $output);

        $valores = array();

        preg_match_all('/(\S?\d+.\d+)e\+\d+/', $output, $valores);

        return $valores[1];
    }
?>