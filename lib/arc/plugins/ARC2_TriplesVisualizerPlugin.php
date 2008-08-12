
<?php
/*
homepage: ARC or plugin homepage
license:  http://arc.semsol.org/license

class:    ARC2 Triples Visualizer Plugin
author:   Luis A. Paulo
version:  2008-08-05
*/

ARC2::inc('Class');

class ARC2_TriplesVisualizerPlugin extends ARC2_Class {

  function __construct ($a = '', &$caller) {
    parent::__construct($a, $caller);
  }
  
  function ARC2_TriplesVisualizerPlugin ($a = '', &$caller) {
    $this->__construct($a, $caller);
  }

  function __init () {
    parent::__init();
    $this->graphviz_path = $this->v('graphviz_path', '/usr/localbin/dot', $this->a);
    $this->graphviz_temp = $this->v('graphviz_temp', '/tmp/', $this->a);
  }

	/**
	* Display graph visualization on an <img> tag.
	* returns null on error
	* @param	array	$res
	* @param	array	$infos
	* @return	string 
	* @access	public
	*/
	function echo_PNG (&$res, &$infos) {
		$format='png';
		$output=self::draw($res,$infos,$format,'base64');
		if ($this->getErrors()) {
			return $output;
		};
		echo '<img src="data:image/'.$format.';base64,'.$output.'"/>';
	}

	/**
	* Returns graph visualization result according to format and enconde params.
	* returns null on error
	* @param	array	$res
	* @param	array	$infos
	* @param	array	$format = 'dot'
	* @param	array	$encode = 'raw'
	* @return	string
	* @access	public
	*/
	function draw($triples, $format = 'dot', $encode = 'raw') {
		$dot=self::dot($triples, $format);
		if (!in_array($encode, array('raw', 'base64', 'gzip'))) {
			$this->addError('Unsupported encode "'.$encode.'"');
		};
		if (self::getErrors()) {
			return $dot;
		};
	
		mt_srand((double)microtime()*1000000);
		$filename=$this->graphviz_temp.md5(uniqid(mt_rand())).".dot";
		$file_handle = fopen($filename, 'w');
		if ($file_handle) {
			fwrite($file_handle, $dot);
			fclose($file_handle);
		};
		$dotinput = " -T" . $format . " " . $filename;

    $lines = array();
		exec($this->graphviz_path . " -T" . $format . " " . $filename . ' -o' . $filename . '.' . $format . ' 2>&1', $lines);
    if (file_exists($filename . '.' . $format)) {
      $output = file_get_contents($filename . '.' . $format);
    }
		unlink($filename);
		unlink($filename . '.' . $format);

		switch ($encode){
		case 'base64':
			//echo '<embed type="image/svg+xml" width="100%" height="100%" src="data:image/'.$format.'+xml;base64,'.$img.'"/>';
			//echo '<img src="data:image/png;base64,'.base64_encode($output).'"/>';
			return base64_encode($output);
			break;
		case 'gzip':
			return gzencode($output);
			break;
		default:
			return $output;
		};
	}

	/**
	* Construct dot source file based on a query result.
	*
	* @param	array	$res
	* @param	array	$infos
	* @param	String $format = 'dot'
	* @return	string
	* @access	public
	*/
	function dot($triples, $format = 'dot') {
		if (!in_array($format, array('dot', 'png', 'svg'))) {
			return $this->addError('Unsupported format "'.$format.'"');
		};
    if (ARC2::getStructType($triples) != 'triples') {
			return $this->addError('Input structure is not a triples array.');
		};

		$dot='digraph arc2 {'."\n";

    $ns = $this->v('ns', array(), $this->a);
    $nsc = 0;
    
    $dot .= '_ns_box_';

		// dot general graph parameters
		$dot.='rankdir=LR;'.'ranksep=3;'.'nodesep=0.3;'."\n";

		//$vars= & $res['variables'];
		$nodes=array('uri'=>array()
			,'bnode'=>array()
			,'literal'=>array()
		);
		$edges=array('uri'=>array());

		foreach ($triples as $i=>$t) {
			$type= isset($t['s type']) ? $t['s type'] : $t['s_type'];
			if (!($s=array_search($t['s'],$nodes[$type]))) {
				$s='s'.$i;
				switch ($type) {
				case 'uri':
				case 'bnode':
					$nodes[$type][$s]= &$t['s'];
					break;
				default:
					alert('Invalid type '.$type);
					return '';
				};
			};

			$type= isset($t['o type']) ? $t['o type'] : $t['o_type'];
			if (!($o=array_search($t['o'],$nodes[$type]))) {
				$o='o'.$i;
				switch ($type) {
				case 'uri':
				case 'bnode':
					$nodes[$type][$o]= &$t['o'];
					break;
				case 'literal':
					$nodes[$type][$o]= &$t['o'];
					break;
				default:
					alert('Invalid type '.$type);
					return '';
				};
			};

      /* p */
			$type= 'uri';
			switch ($type) {
			case 'uri':
				$edges[$type][]= array('label'=>&$t['p'],'s'=>$s,'o'=>$o);
				break;
			default:
				alert('Invalid edge type '.$type);
				return '';
			};

		};

		// dot uri parameters
		$dot.="node [shape=ellipse,fontsize=20,style=filled,fillcolor=limegreen];\n";
		foreach ($nodes['uri'] as $i=>$nd) {
			$label=self::guessNamespace($nd);
			$prefix=array_search($label,$ns);
			if ($prefix) {
				$label=self::guessName($nd);
				$label=($label)?$prefix.':'.$label:$nd;
			} else {
				$label=$nd;
			};
			$dot.=$i.'[label="'.$label.'"];'."\n";
		};

		// dot blanknode parameters
		$dot.="node [fillcolor=greenyellow];\n";
		foreach ($nodes['bnode'] as $i=>$nd) {
			$dot.=$i.';'."\n";
		};

		// dot literal parameters
		$dot.="node [shape=box,fontsize=20,style=filled,fillcolor=orange];\n";
		foreach ($nodes['literal'] as $i=>$nd) {
      $label = substr(strip_tags($nd), 0, 80);
			$dot.=$i.'[label="'. $label .'"];'."\n";
		};

		// dot arrows (edge) parameters
		$dot.="edge [samehead,fontsize=20];\n";
		foreach ($edges['uri'] as $nd) {
      $label = $nd['label'];
      if (preg_match('/^(.*[\/#])([^\/\#]*)$/', $nd['label'], $m)) {
        $ns_uri = $m[1];
        $lname = $m[2];
        if (!$prefix = array_search($ns_uri, $ns)) {
          $ns['ns' . $nsc] = $ns_uri;
          $prefix = 'ns' . $nsc;
          $nsc++;
        }
        $label = $prefix . ':' . $lname;
      }
			$dot.=$nd['s'].' -> '.$nd['o'].'[label="'.$label.'"];'."\n";
		};
    
		$dot.='}'."\n";
    
    /* ns box */
    $sub_r = ''; 
    if ($ns) {
			$sub_r .= 'node [shape=record,fontsize=20,style=filled,color=black,fillcolor=gray];'."\n";
      $first = 1;
      foreach ($ns as $prefix => $uri) {
  			$sub_r .= ($first) ? 'struct [label="' : '|';
  			$sub_r .= $prefix . ': \<' . $uri . '\>';
        $first = 0;
      }
      $sub_r .= '"];'."\n";
    }
    $dot = str_replace('_ns_box_', $sub_r, $dot);
    
		return $dot;
	}

	/**
	* Extracts the namespace prefix out of a URI.
	*
	* @param	String	$uri
	* @return	string
	* @access	public
	*/
	function guessNamespace ($uri) {
		$l = self::getNamespaceEnd($uri);
		return $l > 1 ? substr($uri ,0, $l) : "";
	}

	/**
	* Delivers the name out of the URI (without the namespace prefix).
	*
	* @param	String	$uri
	* @return	string
	* @access	public
	*/
	function guessName ($uri) {
		return substr($uri,self::getNamespaceEnd($uri));
	}

	/**
	* Position of the namespace end
	* Method looks for # : and /
	* @param	String	$uri
	* @access	private
	*/
	function getNamespaceEnd ($uri) {
		$l = strlen($uri)-1;
		do {
			$c = substr($uri, $l, 1);
			if($c == '#' || $c == ':' || $c == '/')
			break;
			$l--;
		} while ($l >= 0);
		$l++;
		return $l;
	}

}

?>