<?php
/*
homepage: http://arc.semsol.org/
license:  http://arc.semsol.org/license

class:    ARC2_ExhibitJSONSerializerPlugin
author:   Keith Alexander
version:  2008-06-17
*/

ARC2::inc('RDFSerializer');

class ARC2_ExhibitJSONSerializerPlugin extends ARC2_RDFSerializer {

	const DC = 'http://purl.org/dc/elements/1.1/';
	const RDFS = 'http://www.w3.org/2000/01/rdf-schema#';
	const FOAF = 'http://xmlns.com/foaf/0.1/';
	const FOAF_SPEC = 'http://xmlns.com/foaf/spec/';
	const RDF = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
	const XSD = 'http://www.w3.org/2001/XMLSchema#';
	const RSS = 'http://purl.org/rss/1.0/';
	const OWL = 'http://www.w3.org/2002/07/owl#';


	var $lang = false;

  function __construct($a = '', &$caller) {
	if(isset($a['lang'])) $this->lang = $a['lang'];
    parent::__construct($a, $caller);
  }
  
  function ARC2_ExhibitJSONSerializerPlugin($a = '', &$caller) {
    $this->__construct($a, $caller);
  }

  function __init() {
    parent::__init();
  }

	function get_label($props)
	{

		$title_candidates = array(
			self::DC.'title',
			self::RSS.'title',
			self::FOAF.'name',
			self::RDFS.'label',
			'http://schemas.talis.com/2005/service/schema#name',
			self::FOAF.'mbox',
			);

		//try in this language
		foreach($title_candidates as $title_prop){
			if(isset($props[$title_prop])){
				if($this->lang){
					foreach($props[$title_prop] as $obj){
						if(isset($obj['lang']) AND $obj['lang']==$this->lang){
							return $obj['value'];
						}
					}
				}
				
				return $props[$title_prop][0]['value'];					
			}
		}
		return false;
	}



	function split_uri($term_uri){
		preg_match('@^(.+?[/#])([^/#]+)$@',$term_uri, $p_match);
		array_shift($p_match);
		return  $p_match;
	}
	
	function uri_to_term($uri){
		$term =  array_pop($this->split_uri($uri));
		return $term;
	}
	
	function uri_to_label($uri){
		$term = $this->uri_to_term($uri);
		return ucwords(preg_replace('/([a-z])([A-Z])/','$1 $2', str_replace('_','',$term)));
	}
	
  /*  */
	function getSerializedIndex($resources){
		
		$exhibit = array(
					'items' => array(
									),
					'properties' => array(
						
						'label'=> array(
									'uri'=> 'http://www.w3.org/2000/01/rdf-schema#label'
									),
						
						),
					'types' => array(
						
						'item' => array(
							'label' => 'Item',
							'pluralLabel' => 'Items',
							),
						),
					); // the target exhibit data structure
	
	
		foreach($resources as $uri => $properties)
		{
			if(isset($properties['http://www.w3.org/1999/02/22-rdf-syntax-ns#type'])){
				$rdf_type =$properties['http://www.w3.org/1999/02/22-rdf-syntax-ns#type'][0]['value'];
				$rdf_type_term = $this->uri_to_term($rdf_type);
				$exhibit['types'][$rdf_type_term] = array('label'=> $this->uri_to_label($rdf_type), );				
			}
			$item = array(
				'id' => $uri,
				'label' => $this->get_label($properties),
				'type' =>  (!empty($rdf_type_term))? $rdf_type_term : 'item',
				);

			foreach($properties as $property => $objects)
			{
				$qname = $this->uri_to_term($property);
				$exhibit['properties'][$qname] = array(
						'uri' => $property,
						'label' => $this->uri_to_label($property),
					);

				$values = array();
				foreach($objects as $object)
				{
					switch(true)
					{
						default :
						case (empty($object['datatype']) AND $object['type']=='literal') :
							$valuetype = 'text';
							break;
						case (isset($resources[$object['value']]) AND ($object['type']=='uri' OR $object['type']=='iri')) :
							$valuetype = 'item';
							break;
						case (!isset($resources[$object['value']]) AND ($object['type']=='uri' OR $object['type']=='iri')) :
							$valuetype = 'url';
							break;
						case (isset($object['datatype']) AND $object['datatype'] == self::XSD.'int') :
							$valuetype = 'number';
							break;
						case (isset($object['datatype']) AND $object['datatype'] == self::XSD.'date') :
							$valuetype = 'date';
							break;
						case (isset($object['datatype']) AND $object['datatype'] == self::XSD.'boolean') :
							$valuetype = 'boolean';
							break;						
					}
						$exhibit['properties'][$qname]['valueType'] = $valuetype;
						$values[]=$object['value'];

					
				}
				if(count($values)==1) $item[$qname] = $values[0];
				else $item[$qname] = $values;
				
			}
			
			$exhibit['items'][]=$item;
		}
		
		return json_encode($exhibit);
	}
  /*  */

}
?>