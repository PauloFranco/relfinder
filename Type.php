<?php
	function sameType($name){
		return "PREFIX db: <http://dbpedia.org/resource/>
		PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
		PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
		SELECT ?subject
		WHERE {
		  ?subject dbo:type ?type.
		   <".$name."> dbo:type ?type

		}";
	}
?>