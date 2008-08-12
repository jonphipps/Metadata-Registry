<?php
/*
homepage: ARC or plugin homepage
license:  http://arc.semsol.org/license

class:    ARC2 SPARQLScript Processor
author:   
version:  2008-07-19 (Tweak: excluding unused prefix declarations during query construction
                      Addition: getArraySerialization method
                      Addition: sparqlscript_max_operations and sparqlscript_max_queries config options
                      Addition: processVarMergeAssignmentBlock)
*/

ARC2::inc('Class');

class ARC2_SPARQLScriptProcessor extends ARC2_Class {

  function __construct($a = '', &$caller) {
    parent::__construct($a, $caller);
  }
  
  function ARC2_SPARQLScriptProcessor ($a = '', &$caller) {
    $this->__construct($a, $caller);
  }

  function __init() {
    parent::__init();
    $this->max_operations = $this->v('sparqlscript_max_operations', 0, $this->a);
    $this->max_queries = $this->v('sparqlscript_max_queries', 0, $this->a);
    $this->env = array(
      'endpoint' => '',
      'vars' => array(),
      'output' => '',
      'operation_count' => 0,
      'query_count' => 0,
    );
  }

  /*  */
  
  function processScript($s) {
    $r = array();
    $parser = $this->getParser();
    $parser->parse($s);
    $blocks = $parser->getScriptBlocks();
    if ($parser->getErrors()) return 0;
    foreach ($blocks as $block) {
      $sub_r = $this->processBlock($block);
      if ($this->getErrors()) return 0;
    }
  }

  /*  */
  
  function getParser() {
    ARC2::inc('SPARQLScriptParser');
    return new ARC2_SPARQLScriptParser($this->a, $this);
  }
  
  /*  */

  function replacePlaceholders($val, $context = '') {
    while (preg_match('/\$\{([^\}]+)\}/', $val, $m)) {
      $sub_val = $this->getPlaceholderValue($m[1]);
      if (is_array($sub_val)) $sub_val = $this->getArraySerialization($sub_val, $context);
      $val = str_replace('${' . $m[1] . '}', $sub_val, $val);
    }
    return $val;
  }
  
  function getPlaceholderValue($ph) {
    /* simple vars */
    if (isset($this->env['vars'][$ph])) return $this->env['vars'][$ph]['value'];
    /* GET/POST */
    if (preg_match('/^(GET|POST)\.(.*)$/i', $ph, $m)) {
      $vals = strtoupper($m[1]) == 'GET' ? $_GET : $POST;
      return isset($vals[$m[2]]) ? $vals[$m[2]] : '';
    }
    /* NOW */
    if (preg_match('/^NOW(.*)$/', $ph, $m)) {
      $r = array(
        'y' => date('Y'),
        'mo' => date('m'),
        'd' => date('d'),
        'h' => date('H'),
        'mi' => date('i'),
        's' => date('s')
      );
      if (preg_match('/(\+|\-)\s*([0-9]+)(y|mo|d|h|mi|s)/is', trim($m[1]), $m2)) {
        eval('$r[$m2[3]] ' . $m2[1] . '= (int)' . $m2[2] . ';');
      }
      $uts = mktime($r['h'], $r['mi'], $r['s'], $r['mo'], $r['d'], $r['y']);
      $uts -= date('Z', $uts); /* timezone offset */
      return date('Y-m-d\TH:i:s\Z', $uts);
    }
    /* property */
    if (preg_match('/^([^\.]+)\.(.+)$/', $ph, $m)) {
      list($var, $path) = array($m[1], $m[2]);
      if (isset($this->env['vars'][$var])) {
        return $this->getPropertyValue($this->env['vars'][$var], $path);
      }
    }
    return '';
  }
  
  function getPropertyValue($obj, $path) {
    $val = $obj['value'];
    /* reserved */
    if ($path == 'size') {
      if ($obj['value_type'] == 'rows') return count($val);
      if ($obj['value_type'] == 'literal') return strlen($val);
    }
    /* struct */
    if (is_array($val)) {
      if (isset($val[$path])) return $val[$path];
      if (preg_match('/^([^\.]+)\.(.+)$/', $path, $m)) {
        list($var, $path) = array($m[1], $m[2]);
        if (isset($val[$var])) {
          return $this->getPropertyValue(array('value' => $val[$var]), $path);
        }
        return '';
      }
    }
    return '';
  }
  
  function getArraySerialization($v, $context) {
    $v_type = ARC2::getStructType($v);/* string|array|triples|index */
    $pf = ARC2::getPreferredFormat();
    /* string */
    if ($v_type == 'string') return $v;
    /* simple array (e.g. from SELECT) */
    if ($v_type == 'array') {
      $m = method_exists($this, 'toLegacy' . $pf) ? 'toLegacy' . $pf : 'toLegacyXML';
    }
    /* rdf */
    if (($v_type == 'triples') || ($v_type == 'index')) {
      $m = method_exists($this, 'to' . $pf) ? 'to' . $pf : ($context == 'query' ? 'toNTriples' : 'toRDFXML');
    }
    return $this->$m($v);
  }

  /*  */

  function processBlock($block) {
    if ($this->max_operations && ($this->env['operation_count'] >= $this->max_operations)) return $this->addError('Number of ' . $this->max_operations . ' allowed operations exceeded.');
    $this->env['operation_count']++;
    $type = $block['type'];
    $m = 'process' . $this->camelCase($type) . 'Block';
    if (method_exists($this, $m)) {
      return $this->$m($block);
    }
    return $this->addError('Unsupported block type "' . $type . '"');
  }

  /*  */
  
  function processEndpointDeclBlock($block) {
    $this->env['endpoint'] = $block['endpoint'];
    return $this->env;
  }

  /*  */

  function processQueryBlock($block) {
    if ($this->max_queries && ($this->env['query_count'] >= $this->max_queries)) return $this->addError('Number of ' . $this->max_queries . ' allowed queries exceeded.');
    $this->env['query_count']++;
    $ep_uri = $this->env['endpoint'];
    /* q */
    $q = 'BASE <' . $block['base']. '>';
    $ns = isset($this->a['ns']) ? array_merge($this->a['ns'], $block['prefixes']) : $block['prefixes'];
    foreach ($ns as $k => $v) {
      $k = rtrim($k, ':');
      $q .= (strpos($block['query'], $k . ':') !== false) ? "\n" . 'PREFIX ' . $k . ': <' . $v . '>' : '';
    }
    $q .= "\n" . $block['query'];
    /* placeholders */
    $q = $this->replacePlaceholders($q, 'query');
    $this->env['query_log'][] = '(' . $ep_uri . ') ' . $q;
    /* local store */
    if ((!$ep_uri || $ep_uri == ARC2::getScriptURI()) && ($this->v('sparqlscript_default_endpoint', '', $this->a) == 'local')) {
      if (!isset($this->local_store)) $this->local_store = ARC2::getStore($this->a);/* @@todo error checking */
      return $this->local_store->query($q);
    }
    elseif ($ep_uri) {
      ARC2::inc('RemoteStore');
      $conf = array_merge($this->a, array('remote_store_endpoint' => $ep_uri));
      $store =& new ARC2_RemoteStore($conf, $this);
      return $store->query($q, '', $ep_uri);
    }
    else {
      return $this->addError("no store");
    }
  }

  /*  */

  function processAssignmentBlock($block) {
    $sub_type = $block['sub_type'];
    $m = 'process' . $this->camelCase($sub_type) . 'AssignmentBlock';
    if (!method_exists($this, $m)) return $this->addError('Unknown method "' . $m . '"');
    return $this->$m($block);
  }

  function processQueryAssignmentBlock($block) {
    $qr = $this->processQueryBlock($block['query']);
    if ($this->getErrors()) return 0;
    $qt = $qr['query_type'];
    $vts = array('ask' => 'bool', 'select' => 'rows', 'desribe' => 'doc', 'construct' => 'doc');
    $r = array(
      'value_type' => isset($vts[$qt]) ? $vts[$qt] : $qt . ' result',
      'value' => ($qt == 'select') ? $qr['result']['rows'] : $qr['result'],
    );
    $this->env['vars'][$block['var']['value']] = $r;
  }
  
  function processStringAssignmentBlock($block) {
    $r = array('value_type' => 'literal', 'value' => $block['string']['value']);
    $this->env['vars'][$block['var']['value']] = $r;
  }
  
  function processVarAssignmentBlock($block) {
    if (isset($this->env['vars'][$block['var2']['value']])) {
      $this->env['vars'][$block['var']['value']] = $this->env['vars'][$block['var2']['value']];
    }
    else {
      $this->env['vars'][$block['var']['value']] = array('value_type' => 'undefined', 'value' => '');
    }
  }
  
  function processPlaceholderAssignmentBlock($block) {
    $ph_val = $this->getPlaceholderValue($block['placeholder']['value']);
    $this->env['vars'][$block['var']['value']] = array('value_type' => 'undefined', 'value' => $ph_val);
  }
  
  function processVarMergeAssignmentBlock($block) {
    $val1 = isset($this->env['vars'][$block['var2']['value']]) ? $this->env['vars'][$block['var2']['value']] : array('value_type' => 'undefined', 'value' => '');
    $val2 = isset($this->env['vars'][$block['var3']['value']]) ? $this->env['vars'][$block['var3']['value']] : array('value_type' => 'undefined', 'value' => '');
    if (is_array($val1) && is_array($val2)) {
      $this->env['vars'][$block['var']['value']] = array('value_type' => $val2['value_type'], 'value' => array_merge($val1['value'], $val2['value']));
    }
    elseif (is_numeric($val1) && is_numeric($val2)) {
      $this->env['vars'][$block['var']['value']] = $val1 + $val2;
    }
  }
  
  /*  */
  
  function processIfblockBlock($block) {
    if ($this->testCondition($block['condition'])) {
      $blocks = $block['blocks'];
    }
    else {
      $blocks = $block['else_blocks'];
    }
    foreach ($blocks as $block) {
      $sub_r = $this->processBlock($block);
      if ($this->getErrors()) return 0;
    }
  }
  
  function testCondition($cond) {
    $m = 'test' . $this->camelCase($cond['type']) . 'Condition';
    if (!method_exists($this, $m)) return $this->addError('Unknown method "' . $m . '"');
    return $this->$m($cond);
  }

  function testVarCondition($cond) {
    $r = 0;
    $vn = $cond['value'];
    if (isset($this->env['vars'][$vn])) $r = $this->env['vars'][$vn]['value'];
    $op = $this->v('operator', '', $cond);
    if ($op == '!') $r = !$r;
    return $r ? true : false;
  }
  
  function testPlaceholderCondition($cond) {
    $val = $this->getPlaceholderValue($cond['value']);
    $r = $val ? true : false;
    $op = $this->v('operator', '', $cond);
    if ($op == '!') $r = !$r;
    return $r;
  }
  
  function testExpressionCondition($cond) {
    $m = 'test' . $this->camelCase($cond['sub_type']) . 'ExpressionCondition';
    if (!method_exists($this, $m)) return $this->addError('Unknown method "' . $m . '"');
    return $this->$m($cond);
  }
  
  function testRelationalExpressionCondition($cond) {
    $op = $cond['operator'];
    if ($op == '=') $op = '==';
    $val1 = $this->getPatternValue($cond['patterns'][0]);
    $val2 = $this->getPatternValue($cond['patterns'][1]);
    eval('$result = ($val1 ' . $op . ' $val2) ? 1 : 0;');
    return $result;
  }

  function getPatternValue($pattern) {
    $m = 'get' . $this->camelCase($pattern['type']) . 'PatternValue';
    if (!method_exists($this, $m)) return '';
    return $this->$m($pattern);
  }

  function getLiteralPatternValue($pattern) {
    return $pattern['value'];
  }
  
  function getPlaceholderPatternValue($pattern) {
    return $this->getPlaceholderValue($pattern['value']);
  }
  
  /*  */
  
  function processForblockBlock($block) {
    $set = $this->v($block['set'], array('value' => array()), $this->env['vars']);
    $entries = $set['value'];
    $iterator = $block['iterator'];
    $blocks = $block['blocks'];
    foreach ($entries as $entry) {
      $this->env['vars'][$iterator] = array('value' => $entry, 'value_type' => $set['value_type'] . ' entry');
      foreach ($blocks as $block) {
        $this->processBlock($block);
        if ($this->getErrors()) return 0;
      }
    }
  }
  
  /*  */

  function processLiteralBlock($block) {
    $this->env['output'] .= $this->replacePlaceholders($block['value'], 'output');
  }

  /*  */
  
  function extractVars($pattern, $input = '') {
    $vars = array();
    if (preg_match_all('/([\?\$]\{([^\}]+)\}|\([^\)]+\))/', $pattern, $m)) {
      $phs = $m[1];
      $vars = $m[2];
      $regex = $pattern;
      $offsets = array();
      foreach ($phs as $ph) {
        if (preg_match('/^[\?\$]/', $ph)) {/* it's not a (foo|bar) */
          $regex = str_replace($ph, '(.+)', $regex);
        }
      }
      if (@preg_match('/' . $regex . '/is', $input, $m)) {
        $vals = $m;
      }
      else {
        return 0;
      }
      for ($i = 0; $i < count($vars); $i++) {
        if ($vars[$i]) {
          $this->env['vars'][$vars[$i]] = array(
            'value_type' => 'literal',
            'value' => isset($vals[$i + 1]) ? $vals[$i + 1] : ''
          );
        }
      }
      return 1;
    }
    /* no placeholders */
    return ($pattern == $input) ? 1 : 0;
  }
  
  /*  */
  
}