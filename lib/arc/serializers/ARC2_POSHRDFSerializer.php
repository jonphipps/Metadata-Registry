<?php
/*
homepage: http://arc.semsol.org/
license:  http://arc.semsol.org/license

class:    ARC2 POSH RDF Serializer
author:   Benjamin Nowack
version:  2008-07-22
*/

ARC2::inc('RDFSerializer');

class ARC2_POSHRDFSerializer extends ARC2_RDFSerializer {

  function __construct($a = '', &$caller) {
    parent::__construct($a, $caller);
  }
  
  function ARC2_POSHRDFSerializer($a = '', &$caller) {/* ns */
    $this->__construct($a, $caller);
  }

  function __init() {
    parent::__init();
    $this->content_header = 'text/html';
  }

  /*  */
  
  function getLabel($res, $ps = '') {
    if (!$ps) $ps = array();
    foreach ($ps as $p => $os) {
      if (preg_match('/[\/\#](name|label|summary|title|fn)$/i', $p)) {
        return $os[0]['value'];
      }
    }
    return preg_replace("/^(.*[\/\#])([^\/\#]+)$/", '\\2', str_replace('_', ' ', $res));
  }
  
  function getSerializedIndex($index, $res = '') {
    $r = '';
    $n = "\n";
    if ($res) $index = array($res => $index[$res]);
    //return Trice::dump($index);
    foreach ($index as $s => $ps) {
      /* label */
      $r .= '<h1>' . $this->getLabel($s, $ps) . '</h1>';
      /* props */
      $r .= $n . '<dl class="poshrdf-node">';
      foreach ($ps as $p => $os) {
        $r .= $n . '  <dt class="poshrdf-arc">' . ucfirst($this->getLabel($p)) . '</dt>';
        foreach ($os as $o) {
          $r .= $n . $this->getObjectValue($o);
        }
      }
      $r .= $n . '</dl>';
    }
    return $r;
  }
  
  function getObjectValue($o) {
    return '<dd>' . $o['value'] . '</dd>';
  }
  
  /*  */

}

