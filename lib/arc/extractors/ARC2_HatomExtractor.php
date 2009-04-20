<?php
/*
homepage: http://arc.semsol.org/
license:  http://arc.semsol.org/license

class:    ARC2 hCalendar Extractor
author:   Benjamin Nowack
version:  2008-05-27
*/

ARC2::inc('MicroformatsExtractor');

class ARC2_HatomExtractor extends ARC2_MicroformatsExtractor {

  function __construct($a = '', &$caller) {
    parent::__construct($a, $caller);
  }
  
  function ARC2_HatomExtractor($a = '', &$caller) {
    $this->__construct($a, $caller);
  }

  function __init() {
    parent::__init();
    $this->terms = array(
      /* root  */
      'hentry',
      /* skipped */
      '#bookmark',
      /* props */
      'author', 'entry-title', 'entry-content', 'entry-summary', 'published', 'updated',
    );
    $this->a['ns']['rss'] = 'http://purl.org/rss/1.0/';
    $this->a['ns']['dct'] = 'http://purl.org/dc/terms/';
    $this->a['ns']['dc'] = 'http://purl.org/dc/elements/1.1/';
  }

  /*  */
  
  function extractRDF() {
    foreach ($this->nodes as $n) {
      if (!$vals = $this->v('class m', array(), $n['a'])) continue;
      if (!in_array('hentry', $vals)) continue;
      /* hentry  */
      $t_vals = array(
        's' => $this->getBookmark($n),
        's_type' => $this->a['ns']['rss'].'item',
      );
      $t = ' ?s a ?s_type . ';
      /* properties */
      foreach ($this->terms as $term) {
        $m = 'extract' . $this->camelCase($term);
        if (method_exists($this, $m)) {
          list ($t_vals, $t) = $this->$m($n, $t_vals, $t);
        }
      }
      /* result */
      $doc = $this->getFilledTemplate($t, $t_vals, $n['doc_base']);
      $this->addTs(ARC2::getTriplesFromIndex($doc));
    }
  }
  
  /*  */
  
  function extractSimple($n, $t_vals, $t, $cls, $prop = '') {
    if ($sub_ns = $this->getSubNodesByClass($n, $cls)) {
      $tc = 0;
      $prop = $prop ? $prop : 'rss:' . $cls;
      foreach ($sub_ns as $sub_n) {
        $var = $this->normalize($cls) . '_'. $tc;
        if ($t_vals[$var] = $this->getNodeContent($sub_n)) {
          $t .= '?s ' . $prop . ' ?' . $var . ' . ';
          $tc++;
        }
      }
    }
    return array($t_vals, $t);
  }

  /*  */

  function extractEntryTitle($n, $t_vals, $t) {
    $r = $this->extractSimple($n, $t_vals, $t, 'entry-title', 'rss:title');
    if (strpos($r[1], 'rss:title')) return $r;
    return $this->extractSimple($n, $t_vals, $t, 'entry-content', 'rss:title');
  }
  
  function extractEntryContent($n, $t_vals, $t) {
    return $this->extractSimple($n, $t_vals, $t, 'entry-content', 'rss:description');
  }
  
  function extractAuthor($n, $t_vals, $t) {
    if ($sub_n = $this->getSubNodeByClass($n, 'author')) {
      return $this->extractSimple($sub_n, $t_vals, $t, 'fn', 'dc:creator');
    }
  }
  
  function extractEntrySummary($n, $t_vals, $t) {
    return $this->extractSimple($n, $t_vals, $t, 'entry-summary', 'rss:description');
  }
  
  function extractPublished($n, $t_vals, $t) {
    $r = $this->extractSimple($n, $t_vals, $t, 'published', 'dc:date');
    if (strpos($r[1], 'dc:date')) return $r;
    return $this->extractSimple($n, $t_vals, $t, 'updated', 'dc:date');
  }
  
  /*  */

}
