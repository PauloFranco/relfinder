<?php
	function allRelations($nome){
		return "PREFIX db: <http://dbpedia.org/resource/>
	        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
	        PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
	        SELECT ?subject SAMPLE(?pf1) WHERE {
	         ?subject ?pf1 <".$nome.">
	        FILTER ((?pf1 != rdf:type ) &&
	        (?pf1 != skos:subject ) &&
	        (?pf1 != <http://dbpedia.org/property/wikiPageUsesTemplate> ) &&
	        (?pf1 != <http://dbpedia.org/property/wordnet_type> ) &&
					(?pf1 != <http://dbpedia.org/ontology/wikiPageRedirects> )
	        )
	        }
	        GROUP BY ?subject";
	}
?>