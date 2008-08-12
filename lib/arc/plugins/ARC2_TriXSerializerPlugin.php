<?php
/*
homepage: http://arc.semsol.org/
license:  http://arc.semsol.org/license

class:    ARC2_TriXSerializerPlugin
author:   Keith Alexander
version:  2008-06-17
*/

ARC2::inc('RDFSerializer');

class ARC2_TriXSerializerPlugin extends ARC2_RDFSerializer {

  function __construct($a = '', &$caller) {
    parent::__construct($a, $caller);
  }
  
  function ARC2_TriXSerializerPlugin($a = '', &$caller) {
    $this->__construct($a, $caller);
  }

  function __init() {
    parent::__init();
  }

  /*  */
  	function getSerializedIndex($index){
				$xml = '';
				foreach($index as $uri => $properties)
				{
					$subject = (substr($uri,0,2)=='_:')? "<id>{$uri}</id>" : "<uri>{$uri}</uri>";
					foreach($properties as $property => $objects)
					{
						foreach($objects as $object)
						{
							if($object['type']=='literal')
							{
								if(isset($object['datatype']))
								{
									$object_markedup='<typedLiteral datatype="'.$object['datatype'].'"><![CDATA['.$object['value'].']]></typedLiteral>';
								}
								else
								{
									$lang = (isset($object['lang']))? ' xml:lang="'.$object['lang'].'"' : '';
									$object_markedup="<plainLiteral{$lang}><![CDATA[{$object['value']}]]></plainLiteral>";
								}
							}
							elseif($object['type']=='bnode')
							{
								$object_markedup="<id>{$object['value']}</id>";
							}
							elseif($object['type']=='uri' || $object['type']=='uri')
							{
								$object_markedup="<uri>{$object['value']}</uri>";
							}
							else
							{
								break 2; //non-standard, so skip this triple
							}

							$xml.=<<<_TRIX_

<triple>
	{$subject}
	<uri>{$property}</uri>
	{$object_markedup}	
</triple>

_TRIX_;
						}
					}
				}

$trix_container = <<<_TRIX_
<?xml version="1.0"?>
<TriX xmlns="http://www.w3.org/2004/03/trix/trix-1/">
<graph>
{$xml}
</graph>
</TriX>
_TRIX_;


		return ($trix_container);

	}


  /*  */

}
?>