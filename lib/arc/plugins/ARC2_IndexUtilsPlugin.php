<?php
/*
homepage: http://n2.talis.com/svn/playground/kwijibo/PHP/arc/plugins/trunk/ARC2_IndexUtils.php
license:  http://arc.semsol.org/license

class:    ARC2_IndexUtilsPlugin
author:   Keith Alexander
version:  2008-03-03
*/

ARC2::inc('Class');

class ARC2_IndexUtilsPlugin extends ARC2_Class {

	function __construct($a = '', &$caller) {
	  parent::__construct($a, $caller);
	}

	function ARC2_IndexUtils ($a = '', &$caller) {
	  $this->__construct($a, $caller);
	}

	function __init() {
	  parent::__init();
	}

/**
 * filter
 * takes $resources (index array) and $filters (an associative array mapping the keys 'uri', 'property', and 'object' to filter functions)
 * @param $resource associative array of data
 * @param $filters associative array of filter functions, with keys: uri, property, object 
 * @return array
 * @author Keith Alexander
 **/

	function filter($resources, $filters){
		$filtered = array();
		foreach($resources as $uri => $properties){
			if(
				(isset($filters['uri']) AND $uri_pass=call_user_func($filters['uri'], $uri, $properties))
			 		OR !isset($filters['uri'])
			){
				foreach($properties as $property => $objects){
					if(
						(isset($filters['property']) AND call_user_func($filters['property'], $uri, $property, $objects))
						 		OR !isset($filters['property'])){

						foreach($objects as $object){
							if( ( isset($filters['object']) AND call_user_func($filters['object'], $uri, $property, $object) 
								OR !isset($filters['object']) ) ) {
								$filtered[$uri][$property][]=$object;
							}						
						}
					}
				}
			}
		}
		return $filtered;
	}

/**
 * merge
 * merges all  rdf/json-style arrays passed as parameters 
 * @param array1, array2, [array3, ...]
 * @return array
 * @author Keith
 **/	
	
	function merge(){
		$old_bnodeids = array();
		$indexes = func_get_args();
		$current = array_shift($indexes);
		foreach($indexes as $newGraph)
		{
			foreach($newGraph as $uri => $properties)
			{
				/* Make sure that bnode ids don't overlap: 
				_:a in g1 isn't the same as _:a in g2 */

				if(substr($uri,0,2)=='_:')//bnode
				{
					$old_id = $uri;
					$count = 1;

					while(isset($current[$uri]) OR 
					( $old_id!=$uri AND isset($newGraph[$uri]) )
					OR isset($old_bnodeids[$uri])
					)
					{
						$uri.=$count++;
					}

					if($old_id != $uri)	$old_bnodeids[$old_id] = $uri;
				}

				foreach($properties as $property => $objects)
				{
					foreach($objects as $object)
					{
						/* make sure that the new bnode is being used*/
						if($object['type']=='bnode')
						{
							$bnode = $object['value'];

							if(isset($old_bnodeids[$bnode])) $object['value'] = $old_bnodeids[$bnode];
							else //bnode hasn't been transposed
							{
									$old_bnode_id = $bnode;
									$count=1;
									while(isset($current[$bnode]) OR 
									( $object['value']!=$bnode AND isset($newGraph[$bnode]) )
									OR isset($old_bnodeids[$uri])
									)
									{
										$bnode.=$count++;
									}

									if($old_bnode_id!=$bnode)	$old_bnodeids[$old_bnode_id] = $bnode;
									$object['value'] = $bnode;
							}
						}

						if(!isset($current[$uri][$property]) OR !in_array($object, $current[$uri][$property]))
						{
							$current[$uri][$property][]=$object;
						}
					}
				}

			}
		}
		return $current;
	}
	
/**
 * diff
 * returns a simpleIndex consisting of all the statements in array1 that weren't found in any of the subsequent arrays
 * @param array1, array2, [array3, ...]
 * @return array
 * @author Keith
 **/	
	function diff(){
		$indices = func_get_args();
		$base = array_shift($indices);
		$diff = array();
		foreach($base as $base_uri => $base_ps){
			foreach($indices as $index){
				if(!isset($index[$base_uri])){
					$diff[$base_uri] = $base_ps;
				} else {
					foreach($base_ps as $base_p => $base_obs){
						if(!isset($index[$base_uri][$base_p])){
							$diff[$base_uri][$base_p] = $base_obs;
						} else {
							foreach($base_obs as $base_o){
								if(!in_array($base_o, $index[$base_uri][$base_p])){
									$diff[$base_uri][$base_p][]=$base_o;
								}
							}
						}
					}
				}
			}
		}
		
		return $diff;
	}
/**
 * intersect
 * returns a simpleIndex consisting of all the statements in array1 that were also found in any of the subsequent arrays
 * @param array1, array2, [array3, ...]
 * @return array
 * @author Keith
 **/
	function intersect(){
		$indices = func_get_args();
		$base = array_shift($indices);
		
		foreach($base as $base_uri => $base_ps){
			foreach($indices as $index){
				if(!isset($index[$base_uri])){
					unset($base[$base_uri]);
				} else {
					foreach($base_ps as $base_p => $base_obs){
						if(!isset($index[$base_uri][$base_p])){
							unset($base[$base_uri][$base_p]);	
						} else {
							foreach($base_obs as $no => $base_o){
								if(!in_array($base_o, $index[$base_uri][$base_p])){
									unset($base[$base_uri][$base_p][$no]);
								}
							} //base_obs
						} // else base_p is in index
						if(empty($base[$base_uri][$base_p])) unset($base[$base_uri][$base_p]);
						
					}// base_ps
				} // else base uri is in index
			}//indices
			if(empty($base[$base_uri])) unset($base[$base_uri]);
		} //base
		
		return $base;
	}
	
	function reify($resources, $nodeID_prefix='Statement')
	{
		$RDF = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
		$reified = array();
		$statement_no = 1;
		foreach($resources as $uri => $properties){
			foreach($properties as $property => $objects){
				foreach($objects as $object){
					while(!isset($statement_nodeID) OR isset($resources[$statement_nodeID]) OR isset($reified[$statement_nodeID]))
					{
						$statement_nodeID = '_:'.$nodeID_prefix.($statement_no++);
					}
					$reified[$statement_nodeID]= array(
						$RDF.'type'=>array(
								array('type'=>'uri','value'=>$RDF.'Statement')
									),
						$RDF.'subject' => array(array('type'=>  (substr($uri,0,2)=='_:')? 'bnode' : 'uri', 'value'=>$uri)),
						$RDF.'predicate' => array(array('type'=>'uri','value'=>$property)),
						$RDF.'object' => array($object),
								);
					
				}
			}
		}
		
		return ($reified);
	}
	
	/**
	 * dereify
	 *
	 * @return object
	 * @author Keith
	 **/
	function dereify($resources)
	{
		$RDF = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
		foreach($resources as $uri => $properties)
		{
			if(
			isset($properties[$RDF.'subject']) AND
			isset($properties[$RDF.'predicate']) AND
			isset($properties[$RDF.'object']) 
			)
			{
				$subject = $properties[$RDF.'subject'][0]['value'];
				$property = $properties[$RDF.'predicate'][0]['value'];
				$object = $properties[$RDF.'object'][0];
				$resources[$subject][$property][]=$object;
				unset($resources[$uri]);
			}
		}
		return ($resources);
	}
	

}


?>