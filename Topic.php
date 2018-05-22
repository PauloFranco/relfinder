<?php
    
    function topicFeatures(&$classes,$relation_size){
        
        foreach($classes as $class){
            $class[1] = $class[0]/$relation_size;
        }
    }
?>