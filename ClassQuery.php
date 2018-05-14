<?php
	function sameTypeQuery($name){
        return "PREFIX rdf:<http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs:   <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX owl: <http://www.w3.org/2002/07/owl#> 
        select distinct  ?p
        where {  
            <".$name."> rdfs:label ?Nom ;
            foaf:isPrimaryTopicOf ?url ;
            a ?p .
            ?p a owl:Class
        } limit 100";
    }
?>