<?php

/*
homepage: http://arc.semsol.org/
license:  http://arc.semsol.org/license

class:    ARC2_FormRDFConverterPlugin
author:   Keith Alexander
version:  2008-06-17
*/

ARC2::inc('RDFSerializer');


class ARC2_FormRDFConverterPlugin extends ARC2_Class {
	
	/**
	 * resources
	 *
	 * @var string
	 **/
	var $resources;

	var $prefixes;

	var $bnode_counter=0;
	
	var $RDF = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
	
	  function __construct($a = '', &$caller) {
	    parent::__construct($a, $caller);
	  }

	  function ARC2_FormRDFConverterPlugin($a = '', &$caller) {
	    $this->__construct($a, $caller);
	  }

	  function __init() {
	    parent::__init();
	  }


	/**
	 * convertToSimpleIndex
	 * - returns SimpleIndex RDF/PHP associative array structure
	 * - parameter is an associative array with resources key and prefixes key
	 * @param array $value
	 * @return object
	 * @author Keith Alexander
	 **/

	function convertToSimpleIndex($formArray, $resources_key='resources', $prefixes_key='prefixes'){

		$this->prefixes = $formArray[$prefixes_key];
		$this->resources = array();
		$this->bnode_counter = 1;
		foreach( $formArray[$resources_key] as $k => $v)
		{
			$this->convert_subject($k,$v);
		}
	 	return $this->resources;
		
	}
	
	/**
	 * convert_subject
	 *
	 * @return array
	 * @author Keith Alexander
	 **/
	private function convert_subject($k,$v)
	{
		/* Test if is Qname of rdf:type OR resource URI */
		if($this->is_qname($k)) /* Qname */
		{
			if(
			(isset($v['rdf:about']) AND $uri = ($v['rdf:about'])) 
					OR 
			( isset($v['rdf:ID']) AND $uri = $v['rdf:ID']))
			{
			// yay
			}
			else
			{
				$uri = "_:bnode".$this->bnode_counter++;
			}
			$type = $this->qname_to_uri($k, $this->prefixes);
			$this->resources[$uri][$this->RDF.'type'][]=array('type'=>'uri','value'=>$type);
		}
		else /* assume that it's a URI */
		{
			$uri = $k;
		}
		
		$this->convert_properties($uri, $v);
		
	}
	/**
	 * convert_properties
	 *
	 * @return void
	 * @author Keith Alexander
	 **/
	function convert_properties($uri, $properties)
	{
		foreach($properties as $property => $values)
		{
			if(!in_array($property, array('rdf:about','rdf:resource','rdf:nodeID','rdf:ID')))
			{
				/* now split with ^^ and @ to get language or datatype  */
				
				$components = $this->parse_property($property);
				
				$property = $components['property'];
				$lang = $components['lang'];
				$datatype = $components['datatype'];
				
				/* Test if property is Qname or URI */
				if($this->is_qname($property)) /* Qname */
				{
					$property_uri = $this->qname_to_uri($property, $this->prefixes);
				}
				else // assume it's a uri if it's not a qname
				{
					$property_uri = $property;
				}
				
				/* Test if datatype is Qname or URI */
				if($this->is_qname($datatype)) /* Qname */
				{
					$datatype_uri = $this->qname_to_uri($datatype, $this->prefixes);
				}
				else // assume it's a uri if it's not a qname
				{
					$datatype_uri = $datatype;
				}
				
				if(isset($this->resources[$uri]) and isset($this->resources[$uri][$property_uri])) $this->resources[$uri][$property_uri] = array_merge($this->resources[$uri][$property_uri], $this->make_objects($values,$lang, $datatype_uri));
				else $this->resources[$uri][$property_uri] = $this->make_objects($values,$lang, $datatype_uri);
			}
		}
		
	}
	
	function make_objects($value, $lang, $datatype)
	{
		if(is_array($value))
		{
			$objects = array();
			foreach($value as $k => $v)
			{
				if(is_integer($k))
				{
					$objects = array_merge($objects, $this->make_objects($v, $lang, $datatype));
				}
				elseif(strtolower($k)=='rdf:resource')
				{
					$objects[] = array('value'=> $v, 'type'=>'uri');
				}
				elseif(strtolower($k)=='rdf:nodeid')
				{
					$objects[] = array('value'=> $v, 'type'=>'bnode');
				}
				else /* assume URI */
				{
					$objects[] = array('value'=> $k, 'type'=>'uri');
					$this->convert_subject($k,$v);
				}
			}
			
			return $objects;
		}
		else
		{
			$object = array('value'=> $value, 'type'=>'literal');
			if($lang) 		$object['lang'] = $lang;					
			if($datatype) 	$object['datatype'] = $datatype;
			return array($object);				
		}
		
	}
	
	/**
	 * parse_property
	 *
	 * @return array
	 * @author Keith Alexander
	 **/
	function parse_property($property)
	{
		if(strpos($property,'@'))
		{
			$lang_parts = explode('@',$property);
			$lang = array_pop($lang_parts);
			$property = implode('',$lang_parts);
			$datatype=false;
		}
		else if(strpos($property, '^^'))
		{
			$type_parts = explode('^^',$property);
			$datatype = array_pop($type_parts);
			$property = implode('',$type_parts);
			$lang = false;
		}
		else
		{
			list($lang,$datatype,$property) = array(false,false,$property);
		}

		return compact('lang','datatype','property');
	}
	
	/**
	 * to_term
	 *
	 * @param string | boolean $qname
	 * @param string | boolean $separator
	 * @return string
	 * @author Keith Alexander
	 **/
	function to_term($qname, $separator=':')
	{
		return array_pop(explode($separator,$qname));
	}

	/**
	 * qname_to_uri(string $qname, array $namespaces, string $separator)
	 * @param string | boolean $qname
	 * @param array | boolean $namespaces
	 * @param string | boolean $separator
	 *
	 * @return string
	 * @author Keith Alexander
	 **/
	function qname_to_uri($qname, $prefixes=false, $separator=':')
	{
		$parts = explode($separator,$qname);
		$prefix = array_shift($parts);
		$term = implode('',$parts);
		if(!isset($prefixes[$prefix])) return false;
		$uri_value = $prefixes[$prefix].$term;
		return $uri_value;
	}
	
	
	function is_qname($k)
	{
		if (preg_match('/^[a-zA-Z0-9]+:[a-zA-Z0-9_]+$/',$k, $matches)) return true;
		else return false;
	}
	
	
}

?>