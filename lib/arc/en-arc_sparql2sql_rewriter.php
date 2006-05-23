<?php
/*
appmosphere RDF classes (ARC): http://www.appmosphere.com/en-arc

Copyright © 2005 appmosphere web applications, Germany. All Rights Reserved.
This work is distributed under the W3C® Software License [1] in the hope
that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
[1] http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231

ns sk                       http://www.appmosphere.com/ns/site_kit#
ns doap                     http://usefulinc.com/ns/doap#
sk:className                ARC_sparql2sql_rewriter
doap:name                   ARC SPARQL-to-SQL Rewriter
doap:homepage               http://www.appmosphere.com/en-arc_sparql2sql_rewriter
doap:license                http://www.appmosphere.com/en-arc_license
doap:programming-language   PHP
doap:maintainer             Benjamin Nowack
doap:shortdesc              A PHP SPARQL to SQL rewriter for ARC RDF Store
//release
doap:created                2006-02-21
doap:revision               0.2.3
//changelog
sk:releaseChanges           2005-11-08: release 0.1.0
                            2006-01-26: release 0.2.0
                                        - complete re-write
                            2006-02-08: revision 0.2.1
                                        - tweaked DESCRIBE sql
                            2006-02-18: revision 0.2.2
                                        - regex fix
                                        - fixed bug in sub-pattern handling
                            2006-02-21: revision 0.2.3
                                        - security fix: auto-removing * from triple pattern comments 
*/

class ARC_sparql2sql_rewriter{

  var $version="0.2.3";

  var $prefix="";
  var $encode_values=false;
  var $infos=array();
  var $logs=array();
  var $prop_tbl_infos=array();
  
  function __construct($args=""){
    $this->obj_props=array(
      "http://xmlns.com/foaf/0.1/knows",
    );
    $this->dt_props=array(
      "http://xmlns.com/foaf/0.1/name",
      "http://purl.org/dc/elements/1.1/title",
      "http://purl.org/dc/elements/1.1/date"
    );
    if(is_array($args)){
      foreach($args as $k=>$v){$this->$k=$v;}/* infos, prefix, inc_path, encode_values, prop_tables, obj_props, dt_props, iri_alts */
      $this->create_prop_table_infos();
    }
  }
  
  function ARC_sparql2sql_rewriter($args=""){
    $this->__construct($args);
  }

  /*          */
  
  function set_iri_alts($alts=""){
    $this->iri_alts=$alts;
  }
  
  /*          */

  function get_hash($val=""){
    $result="";
    if($val==""){
      return "X_by1-I3bB@@hJ2Tz--=9";
    }
    $val=md5($val);
    $parts=array(substr($val, 0, 11), substr($val, 11, 11), substr($val, 22));
    $alpha='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ !?()+,-.@;=[]_{}';
    $base=strlen($alpha);
    for($i=0;$i<3;$i++){
      $cur_part=$parts[$i];
      $cur_int=hexdec($cur_part);
      $cur_result="";
      for($j=floor(log10($cur_int)/log10($base));$j>=0;$j--){
        $pos=floor($cur_int/pow($base,$j));
        $cur_result.=$alpha{$pos};
        $cur_int-=($pos*pow($base, $j));
      }
      $result.=sprintf("%07s", $cur_result);
    }
    return $result;
  }

  function create_o_comp($val="", $p="", $o_dt=""){
    /* try date */
    if(preg_match("/^[0-9]{1,2}\s+[a-z]+\s+[0-9]{4}/i", $val)){/* e.g. 12 May 2004 */
      if(($uts=strtotime($val)) && ($uts!==-1)){
        return date("Y-m-d\TH:i:s", $uts);
      }
    }
    /* numeric */
    if(is_numeric($val)){
      $val=sprintf("%f", $val);
      if(preg_match("/([\-\+])([0-9]*)\.([0-9]*)/", $val, $matches)){
        return $matches[1].sprintf("%020s", $matches[2]).".".sprintf("%-020s", $matches[3]);
      }
      if(preg_match("/([0-9]*)\.([0-9]*)/", $val, $matches)){
        return "+".sprintf("%020s", $matches[1]).".".sprintf("%-020s", $matches[2]);
      }
      return $val;
    }
    /* any other string: remove linebreaks etc.  */
    //$tmp=rawurlencode(strtolower(strip_tags($val)));
    $tmp=rawurlencode(strip_tags($val));
    foreach(array('%0D', '%0A', '%22', '%27', '%60', '%3C', '%3E') as $cur_char){
      $tmp=str_replace($cur_char, '', $tmp);
    }
    return substr(trim(rawurldecode($tmp)), 0, 255);
  }

  /*          */
  
  function create_prop_table_infos(){
    $base_tbl_name=$this->prefix."_arc_triple";
    if(isset($this->prop_tables)){
      foreach($this->prop_tables as $cur_prop_table){
        $cur_name=$cur_prop_table["name"];
        $cur_prop_type=$cur_prop_table["prop_type"];
        $cur_props=$cur_prop_table["props"];
        foreach($cur_props as $cur_prop){
          $tbl_name=($cur_prop_type=="obj")? $base_tbl_name."_op_".$cur_name : $base_tbl_name."_dp_".$cur_name;
          $this->prop_tbl_infos[$cur_prop]=array("tbl"=>$tbl_name, "type"=>$cur_prop_type);
        }
      }
    }
  }
  
  function get_best_table_name($alias=""){
    if($a_info=$this->alias_prop_infos[$alias]){
      /* graph check */
      if($a_info["in_graph"]){
        return $this->prefix."_arc_triple_all_wdup";
      }
      /* try concrete p iri */
      if($a_info["p_term_type"]=="iri"){
        $p_iri=$a_info["p_term_val"];
        /* check prop_table_infos */
        if($p_infos=$this->prop_tbl_infos[$p_iri]){
          return $p_infos["tbl"];
        }
        /* o is literal */
        if(($a_info["o_term_type"]=="literal") || in_array($p_iri, $this->dt_props)){
          return $this->prefix."_arc_triple_dp";
        }
        /* o is iri */
        if(($a_info["o_term_type"]=="iri") || in_array($p_iri, $this->obj_props)){
          return $this->prefix."_arc_triple_op";
        }
      }
      /* o is literal */
      if($a_info["o_term_type"]=="literal"){
        return $this->prefix."_arc_triple_dp_all";
      }
      /* o is iri */
      if($a_info["o_term_type"]=="iri"){
        return $this->prefix."_arc_triple_op_all";
      }
      /* o is obj */
      if($a_info["o_term_type"]=="var"){
        $o_var_val=$a_info["o_term_val"];
        if($col_occurs=$this->var_col_occurs[$o_var_val]){
          if(in_array("s", $col_occurs)){/* used to join => p is obj prop */
            if(isset($this->prop_tables) && count($this->prop_tables)){
              return $this->prefix."_arc_triple_op_all";
            }
            else{
              return $this->prefix."_arc_triple_op";
            }
          }
        }
      }
    }
    return $this->prefix."_arc_triple_all";
  }
  
  /*          */
  
  function get_sql($infos=""){
    if((!$infos) && (!$infos=$this->infos)){
      return 'missing parameter : infos';
    }
    $this->infos=$infos;
    $this->term2alias=array();
    $this->optional_term2alias=array();
    $this->val_match_vars=array();
    $this->graphs=array();
    
    $mthd="get_".$infos["query_type"]."_sql";
    if(method_exists($this, $mthd)){
      return $this->${mthd}();
    }
    return "";
  }

  /*          */
  
  function get_select_sql(){
    $infos=$this->infos;
    if(isset($this->infos["patterns"])){
      $this->parse_patterns();/* creates where_code, optional_term2alias */
    }
    $has_unions=strpos($this->where_code, "__union_") ? true : false;
    if($has_unions){
      return $this->get_union_select_sql();
    }
    $left_join_code=$this->get_left_join_code();/* detects alias_alternatives */
    /* select */
    $result="SELECT";
    /* distinct */
    $result.=($infos["distinct"]) ? " DISTINCT" : "";
    /* count rows */
    if(isset($infos["count_rows"]) && $infos["count_rows"]){
      $result.=" SQL_CALC_FOUND_ROWS";
    }
    /* vars */
    $result.=$this->get_result_vars_code();
    /* from */
    $result.=$this->get_from_code();
    /* left joins */
    $result.=(strlen($left_join_code)) ? "\n /* left-joins */".$left_join_code : "";
    /* hash2val joins */
    $hash2val_join_code=$this->get_hash2val_join_code();
    $result.=(strlen($hash2val_join_code)) ? $hash2val_join_code : "";
    /* where */
    $result.="\nWHERE \n ";
    $where_result="";
    /* dataset restrictions */
    $dataset_code=$this->get_dataset_code();
    $where_result.=(strlen($dataset_code)) ? "/* dataset restrictions */\n".$dataset_code."\n" : "";
    /* graph restrictions */
    $graph_code=$this->get_graph_code();
    if(strlen($graph_code)){
      $where_result.=(strlen($where_result)) ? " /* graph restrictions */\n AND \n ".$graph_code : " /* graph restrictions */\n ".$graph_code;
      $where_result.="\n";
    }
    /* where_code */
    if(strlen($this->where_code)){
      $where_result.=(strlen($where_result)) ? " /* triple patterns and filters */\n AND \n " : " /* triple patterns and filters */\n ";
      $where_result.=trim($this->where_code);
    }
    /* equi-joins */
    if($equi_join_code=$this->get_equi_join_code()){
      $where_result.=(strlen($where_result)) ? "\n /* equi-joins */\n AND ".$equi_join_code : "\n /* equi-joins */\n ".$equi_join_code;
    }
    $result.=(strlen($where_result)) ?   $where_result : "1";
    /* order by */
    $result.=$this->get_order_by_code();
    /* limit/offset */
    $result.=$this->get_limit_offset_code();
    return $result;
  }
  
  function get_union_select_sql(){
    $infos=$this->infos;
    $result="";
    $where_code=trim($this->where_code);
    while(preg_match("/__union_([0-9]+)__/", $where_code, $matches)){
      $union_id=$matches[1];
      $branches=$this->union_branches[$union_id];
      for($i=0,$i_max=count($branches);$i<$i_max;$i++){
        $union_branch_id=$union_id."_".($i+1);
        $left_join_code=$this->get_left_join_code();/* detects alias_alternatives */
        /* select */
        $cur_result="SELECT";
        /* distinct, not on first branch */
        if(strlen($result)){
          $cur_result.=($infos["distinct"]) ? " DISTINCT" : " ALL";
        }
        /* count rows */
        if(isset($infos["count_rows"]) && $infos["count_rows"]){
          $result.=" SQL_CALC_FOUND_ROWS";
        }
        /* vars */
        $cur_result.=$this->get_result_vars_code(array("union_branch_id"=>$union_branch_id));
        /* from */
        $cur_result.=$this->get_from_code();
        /* left joins */
        $cur_result.=(strlen($left_join_code)) ? "\n /* left-joins */".$left_join_code : "";
        /* hash2val joins */
        $hash2val_join_code=$this->get_hash2val_join_code();
        $cur_result.=(strlen($hash2val_join_code)) ? $hash2val_join_code : "";
        /* where */
        $cur_result.="\nWHERE \n ";
        /* dataset restrictions */
        $dataset_code=$this->get_dataset_code();
        $cur_result.=(strlen($dataset_code)) ? "/* dataset restrictions */\n".$dataset_code."\n" : "";
        /* graph restrictions */
        $graph_code=$this->get_graph_code();
        if(strlen($graph_code)){
          $cur_result.=" /* graph restrictions */";
          $cur_result.=(strlen($dataset_code)) ? "\n AND \n ".$graph_code : "\n ".$graph_code;
          $cur_result.="\n";
        }
        /* where_code */
        $cur_result.=" /* triple patterns and filters */\n ";
        $cur_result.=(strlen($graph_code.$dataset_code)) ? "AND \n " : "";
        $cur_result.=trim($where_code);
        /* equi-joins */
        $equi_join_code=$this->get_equi_join_code();
        $cur_result.=(strlen($equi_join_code)) ? "\n /* equi-joins */\n AND ".$equi_join_code : "";
        /* unions */
        $cur_branch=$branches[$i];
        $branch_result=str_replace("__union_".$union_id."__", $cur_branch, $cur_result);
        $result.=($i==0) ? "(".$branch_result."\n)" : "\nUNION \n(".$branch_result."\n)";
      }
      $where_code=str_replace("__union_".$union_id."__", "", $where_code);
    }
    /* order by */
    $result.=$this->get_order_by_code();
    /* limit/offset */
    $result.=$this->get_limit_offset_code();
    return $result;
  }

  /*          */
  
  function get_construct_sql(){
    /* uses result_vars mentioned in construct template triples */
    return $this->get_select_sql();
  }
  
  /*          */
  
  function get_describe_sql($infos="", $limit=100){
    if($infos){
      $this->infos=$infos;
    }
    /* will be called by ARC RDF Store once for all vars, then for each result_iri separately */
    if(count($this->infos["result_vars"])){
      //$this->infos["distinct"]=true;
      return $this->get_select_sql();
    }
    elseif($this->infos["result_iris"]){
      $iri=$this->infos["result_iris"][0];
      $q='
        SELECT ?ref_s ?ref_p ?p ?o
        WHERE { 
            { ?ref_s  ?ref_p  <'.$iri.'> }
            UNION
            { <'.$iri.'> ?p ?o }
        }
      ';
      $q='SELECT DISTINCT ?p ?o WHERE { <'.$iri.'> ?p ?o } ORDER BY ?p';
      $q.=($limit) ? ' LIMIT '.$limit : "";
      include_once($this->inc_path."ARC_sparql_parser.php");
      $parser=new ARC_sparql_parser();
      $parser->parse($q);
      $this->infos=$parser->get_infos();
      return $this->get_select_sql();
    }
    return "";
  }
  
  /*          */

  function get_ask_sql(){
    $this->infos["result_vars"]=array("__ask_var__");
    $this->infos["limit"]=1;
    $sql=$this->get_select_sql();
    $sql=str_replace("SELECT", "SELECT 1 AS success", $sql);
    return $sql;
  }
  
  /*          */
  
  function get_result_vars_code($args=""){
    $result="";
    $union_branch_id="";
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}/* union_branch_id */
    $vars=$this->infos["result_vars"] ? $this->infos["result_vars"] : array();
    $added_aliases=array();/* each hash2val join needs a separate alias */
    foreach($vars as $cur_var){
      if(($alias_infos=$this->term2alias[$cur_var]) || ($alias_infos=$this->optional_term2alias[$cur_var])){
        $result.=strlen($result) ? ", \n " : "\n ";
        $null_var=false;/* whether var occurs in global pattern or current union_branch */
        $alias_info=$alias_infos[0];
        if($union_branch_id){
          $null_var=true;
          foreach($alias_infos as $cur_alias_info){
            /* todo: nested unions */
            if(!$cur_alias_info["union_branch_id"] || ($cur_alias_info["union_branch_id"]==$union_branch_id)){/* global var */
              $null_var=false;
              $alias_info=$cur_alias_info;
              break;
            }
          }
        }
        $alias=$alias_info["alias"];
        $col=$alias_info["col"];
        $term=$alias_info["term"];
        $tbl_alias="V".$alias;
        $alias_ext=2;
        while(in_array($tbl_alias, $added_aliases)){
          $tbl_alias="V".$alias."_".$alias_ext;
          $alias_ext++;
        }
        $full_tbl_alias=$tbl_alias.".val";
        /* alias alternatives (peer optionals handling) */
        if($alts=$this->alias_alternatives["T".$alias.".".$col]){
          $sub_result="IFNULL(".$tbl_alias.".val, ";
          $sub_result_2="IFNULL(T".$alias.".__placeholder__, ";
          for($i=0,$i_max=count($alts);$i<$i_max;$i++){
            $cur_alt=$alts[$i];
            $alt_alias=$cur_alt["alias"];
            $alt_col=$cur_alt["col"];
            $alt_tbl_alias="V".$alt_alias;
            $alias_ext=2;
            while(in_array($alt_tbl_alias, $added_aliases)){
              $alt_tbl_alias=$cur_alt."_".$alias_ext;
              $alias_ext++;
            }
            $sub_result.=($i<$i_max-1) ? "IFNULL(".$alt_tbl_alias.".val" : $alt_tbl_alias.".val";
            $sub_result_2.=($i<$i_max-1) ? "IFNULL(T".$alt_alias.".__placeholder__" : "T".$alt_alias.".__placeholder__";
          }
          for($i=0;$i<$i_max;$i++){
            $sub_result.=")";
            $sub_result_2.=")";
          }
          $full_tbl_alias=$sub_result;
        }
        $result.=($null_var) ? "CONCAT('NULL ', ".$full_tbl_alias.") AS ".$cur_var : $full_tbl_alias." AS ".$cur_var;
        $added_aliases[]=$tbl_alias;
        if($col=="s"){
          if($sub_result_2){
            $result.=",\n   ".str_replace("__placeholder__", "s_type", $sub_result_2)." AS ".$cur_var."__type";
          }
          else{
            $result.=",\n   T".$alias.".s_type AS ".$cur_var."__type";
          }
        }
        if($col=="o"){
          if($sub_result_2){
            $result.=",\n   ".str_replace("__placeholder__", "o_type", $sub_result_2)." AS ".$cur_var."__type";
            $result.=",\n   ".str_replace("__placeholder__", "o_lang", $sub_result_2)." AS ".$cur_var."__lang";
            $result.=",\n   ".str_replace("__placeholder__", "o_dt", $sub_result_2)." AS ".$cur_var."__dt";
          }
          else{
            $result.=",\n   T".$alias.".o_type AS ".$cur_var."__type";
            $result.=",\n   T".$alias.".o_lang AS ".$cur_var."__lang";
            $result.=",\n   T".$alias.".o_dt AS ".$cur_var."__dt";
          }
        }
      }
      elseif($alias_infos=$this->graph_term2alias[$cur_var]){
        $alias=$alias_infos[0]["alias"];
        $tbl_alias="V".$alias."_g";
        $result.=strlen($result) ? ", \n " : "\n ";
        $result.=$tbl_alias.".val AS ".$cur_var;
      }
    }
    return $result;
  }
  
  /*          */
  
  function get_from_code(){
    $result="";
    $added_aliases=array();
    /* t_count */
    for($i=1;$i<=$this->t_count;$i++){
      if(!in_array($i, $this->optional_t_counts)){
        $result.=strlen($result) ? ", \n " : "\nFROM \n ";
        $tbl_alias="T".$i;
        $alias_ext=2;
        while(in_array($tbl_alias, $added_aliases)){
          $tbl_alias="T".$i."_".$alias_ext;
          $alias_ext++;
        }
        $cur_tbl_name=$this->get_best_table_name($i);
        $result.=$cur_tbl_name." ".$tbl_alias;
        $added_aliases[]=$tbl_alias;
      }
    }
    /* union_t_count */
    if($this->union_count){
      $min_union_t_count=$this->union_t_counts["base_t_count"]+1;
      $max_union_t_count=$min_union_t_count;
      foreach($this->union_t_counts as $union_id=>$cur_max_t_count){
        $max_union_t_count=max($cur_max_t_count, $max_union_t_count);
      }
      for($i=$min_union_t_count;$i<=$max_union_t_count;$i++){
        if(!in_array($i, $this->optional_t_counts)){
          $result.=strlen($result) ? ", \n " : "\nFROM \n ";
          $tbl_alias="T".$i;
          $alias_ext=2;
          while(in_array($tbl_alias, $added_aliases)){
            $tbl_alias="T".$i."_".$alias_ext;
            $alias_ext++;
          }
          $cur_tbl_name=$this->get_best_table_name($i);
          $result.=$cur_tbl_name." ".$tbl_alias;
          $added_aliases[]=$tbl_alias;
        }
      }
    }
    return $result;
  }
  
  /*          */
  
  function get_equi_join_code(){
    $result="";
    $added_joins=array();
    foreach($this->term2alias as $name=>$alias_infos){
      for($i=1,$i_max=count($alias_infos);$i<$i_max;$i++){
        $cur_alias_info_1=$alias_infos[$i-1];
        $cur_alias_1=$cur_alias_info_1["alias"];
        $cur_col_1=$cur_alias_info_1["col"];
        $cur_term_1=$cur_alias_info_1["term"];
        $tbl_alias_1="T".$cur_alias_1.".".$cur_col_1;

        $cur_alias_info_2=$alias_infos[$i];
        $cur_alias_2=$cur_alias_info_2["alias"];
        $cur_col_2=$cur_alias_info_2["col"];
        $cur_term_2=$cur_alias_info_2["term"];
        $tbl_alias_2="T".$cur_alias_2.".".$cur_col_2;
        
        if($tbl_alias_1!=$tbl_alias_2){
          if(!in_array($tbl_alias_1."=".$tbl_alias_2, $added_joins) && !in_array($tbl_alias_2."=".$tbl_alias_1, $added_joins)){
            $result.=(strlen($result)) ? "\n AND " : "";
            $result.=$tbl_alias_1."=".$tbl_alias_2;
            $added_joins[]=$tbl_alias_1."=".$tbl_alias_2;
          }
        }
      }
    }
    return $result;
  }
  
  /*          */

  function get_left_join_code(){
    $result="";
    $added_aliases=array();
    $optional_sets=array();
    $alias2parent_optional=array();
    foreach($this->optional_term2alias as $name=>$alias_infos){
      //$result.="\n".$name;
      foreach($alias_infos as $alias_info){
        $joined_alias=$alias_info["alias"];
        //$result.="\n".$joined_alias;
        if(!in_array("T".$joined_alias, $added_aliases)){
          $joined_col=$alias_info["col"];
          $joined_term=$alias_info["term"];
          $joined_term_val=$joined_term["val"];
          if(($ref_alias_infos=$this->term2alias[$joined_term_val]) || ($ref_alias_infos=$this->optional_term2alias[$joined_term_val])){
            $ref_alias_info=$ref_alias_infos[0];
            $ref_alias=$ref_alias_info["alias"];
            $ref_col=$ref_alias_info["col"];
            $cur_tbl_name=$this->get_best_table_name($joined_alias);
            $result.="\n LEFT JOIN ".$cur_tbl_name." T".$joined_alias." ON ";
            $result.="\n  (";
            $result.="\n   T".$joined_alias.".".$joined_col."=T".$ref_alias.".".$ref_col;
            /* alias patterns */
            if($patterns=$this->optional_patterns["T".$joined_alias]){
              foreach($patterns as $cur_pattern){
                $result.="\n   AND\n   ".$cur_pattern;
              }
            }
            /* other terms in current alias pattern */
            $term_infos=$this->alias2term[$joined_alias];
            foreach($term_infos as $cur_term_info){
              $cur_term=$cur_term_info["term"];
              $cur_term_type=$cur_term["type"];
              $cur_term_val=$cur_term["val"];
              $cur_col=$cur_term_info["col"];
              if($cur_col!=$joined_col){
                //$result.="\nother: ".$cur_term_val." (".$cur_col.")";
                $other_alias_infos=false;
                /* check if term is used in non-optional patterns */
                if($other_alias_infos=$this->term2alias[$cur_term_val]){
                }
                /* check if term is used in *earlier* optional patterns */
                elseif($pre_other_alias_infos=$this->optional_term2alias[$cur_term_val]){
                  $other_alias_infos=array();
                  foreach($pre_other_alias_infos as $cur_other_alias_info){
                    if($cur_other_alias_info["alias"]<$joined_alias){
                      $other_alias_infos[]=$cur_other_alias_info;
                    }
                  }
                }
                if($other_alias_infos){
                  foreach($other_alias_infos as $cur_other_alias_info){
                    $other_alias=$cur_other_alias_info["alias"];
                    $other_col=$cur_other_alias_info["col"];
                    $other_tbl_alias="T".$other_alias.".".$other_col;
                    $result.="\n   AND (";
                    $result.="T".$joined_alias.".".$cur_col."=".$other_tbl_alias;
                    /* find out if other_col is in different optional */
                    if($cur_other_alias_info["optional_count"] && ($cur_other_alias_info["optional_count"]!=$alias_info["optional_count"])){
                      $result.=" OR ".$other_tbl_alias." IS NULL";
                      if(!isset($this->alias_alternatives[$other_tbl_alias])){
                        $this->alias_alternatives[$other_tbl_alias]=array();
                      }
                      $this->alias_alternatives[$other_tbl_alias][]=array("alias"=>$joined_alias, "col"=>$cur_col);
                    }
                    $result.=")";
                  }
                }
              }
            }
            /* dataset restrictions */
            if($dataset_code=$this->get_dataset_code(true, $joined_alias)){
              $result.="\n   AND\n   ".$dataset_code;
            }
            $result.="\n  )";
            $added_aliases[]="T".$joined_alias;
          }
          /* optional groups */
          if(!array_key_exists($alias_info["optional_count"], $optional_sets)){
            $optional_sets[$alias_info["optional_count"]]=array("T".$joined_alias.".".$joined_col);
            if($parent_optional_count=$alias_info["parent_optional_count"]){
              $alias2parent_optional["T".$joined_alias.".".$joined_col]=$parent_optional_count;
            }
          }
          else{
            $optional_sets[$alias_info["optional_count"]][]="T".$joined_alias.".".$joined_col;
          }
        }
      }
    }
    /* optional sets */
    $sub_result="";
    foreach($optional_sets as $k=>$cur_set){
      $null_set=$cur_set;
      $not_null_set=$cur_set;
      $set_entry=$cur_set[0];
      while($parent_set_id=$alias2parent_optional[$set_entry]){
        /* nested optional, only NOT NULL if all parent patterns are NOT NULL as well */
        $parent_set=$optional_sets[$parent_set_id];
        $set_entry=$parent_set[0];
        foreach($parent_set as $cur_alias){
          if(!in_array($cur_alias, $not_null_set)){
            $not_null_set[]=$cur_alias;
          }
        }
      }
      if(count($not_null_set)>1){
        /* not null */
        $not_null_code="";
        foreach($not_null_set as $cur_alias){
          $not_null_code.=strlen($not_null_code) ? " AND " : "";
          $not_null_code.=$cur_alias." IS NOT NULL";
        }
        /* null */
        $null_code="";
        foreach($null_set as $cur_alias){
          $null_code.=strlen($null_code) ? " AND " : "";
          $null_code.=$cur_alias." IS NULL";
        }
        $sub_result.=strlen($sub_result) ? " AND " : "";
        $sub_result.="((".$not_null_code.") OR (".$null_code."))";
        $sub_result.="\n";
      }
    }
    if($sub_result){
      $this->where_code.=strlen($this->where_code) ? "\n AND " : "\n";
      $this->where_code.=$sub_result;
    }
    return $result;
  }
  
  /*          */

  function get_hash2val_join_code(){
    $result="\n /* hash2val joins */";
    $vars=($this->infos["result_vars"]) ? $this->infos["result_vars"] : array();
    /* add regex'd vars */
    foreach($this->val_match_vars as $cur_var){
      if(!in_array($cur_var, $vars)){
        $vars[]=$cur_var;
      }
    }
    $added_aliases=array();/* each hash2val join needs a separate alias */
    $tbl_name=$this->prefix."_arc_hash2val";
    $var2tbl_alias=array();
    foreach($vars as $cur_var){
      $tbl_alias="";
      if(($alias_infos=$this->term2alias[$cur_var]) || ($alias_infos=$this->optional_term2alias[$cur_var])){
        $alias_info=$alias_infos[0];
        $alias=$alias_info["alias"];
        $col=$alias_info["col"];
        $term=$alias_info["term"];
        $tbl_alias="V".$alias;
        $alias_ext=2;
        while(in_array($tbl_alias, $added_aliases)){
          $tbl_alias="V".$alias."_".$alias_ext;
          $alias_ext++;
        }
        $result.="\n LEFT JOIN ".$tbl_name." ".$tbl_alias." ON (";
        $result.="".$tbl_alias.".hash=T".$alias.".".$col;
        $result.=")";
        $added_aliases[]=$tbl_alias;
        /* alias alternatives */
        if($alias_info["optional_count"]){
          foreach($alias_infos as $cur_alias_info){
            $cur_tbl_alias="T".$cur_alias_info["alias"].".".$cur_alias_info["col"];
            if($alts=$this->alias_alternatives[$cur_tbl_alias]){
              foreach($alts as $cur_alt){
                $alt_alias=$cur_alt["alias"];
                $alt_col=$cur_alt["col"];
                $alt_tbl_alias="V".$alt_alias;
                $alias_ext=2;
                while(in_array($alt_tbl_alias, $added_aliases)){
                  $alt_tbl_alias=$cur_alt."_".$alias_ext;
                  $alias_ext++;
                }
                $result.="\n LEFT JOIN ".$tbl_name." ".$alt_tbl_alias." ON (";
                $result.="".$alt_tbl_alias.".hash=T".$alt_alias.".".$alt_col;
                $result.=")";
              }
            }
          }
        }
      }
      elseif($alias_infos=$this->graph_term2alias[$cur_var]){
        $alias=$alias_infos[0]["alias"];
        $tbl_alias="V".$alias."_g";
        $result.="\n LEFT JOIN ".$tbl_name." ".$tbl_alias." ON (";
        $result.="".$tbl_alias.".hash=T".$alias.".g";
        $result.=")";
      }
      if($tbl_alias){
        $var2tbl_alias[$cur_var]=$tbl_alias;
      }
    }
    /* regex'd vars */
    foreach($this->val_match_vars as $cur_var){
      $this->where_code=str_replace("V__regex_match_".$cur_var."__", $var2tbl_alias[$cur_var], $this->where_code);
    }
    return $result;
  }
  
  /*          */

  function get_order_by_code(){
    $result="";
    if($conds=$this->infos["order_conditions"]){
      foreach($conds as $cur_cond){
        $cur_cond_type=$cur_cond["type"];
        $mthd="get_".$cur_cond_type."_order_by_code";
        if(method_exists($this, $mthd)){
          if($sub_result=$this->${mthd}($cur_cond)){
            $result.=(strlen($result)) ? ",\n " : "\n ";
            $result.=$sub_result;
          }
        }
      }
    }
    return (trim($result)) ? "\nORDER BY ".$result : "";
  }
  
  function get_var_order_by_code($cond=""){
    $result="";
    $var=$cond["val"];
    if(($alias_infos=$this->term2alias[$var]) || ($alias_infos=$this->optional_term2alias[$var])){
      $alias_info=$alias_infos[0];
      $alias=$alias_info["alias"];
      $col=$alias_info["col"];
      $term=$alias_info["term"];
      
      $tbl_alias="T".$alias;
      if($col!="o" && in_array($var, $this->infos["result_vars"])){
        $result.=rawurlencode($var);
      }
      elseif($col=="o"){
        /* todo type casting if var is numeric */
        $result.=$tbl_alias.".o_comp";
      }
      else{
        /* todo: sort by val, not by hash */
        $result.=$tbl_alias.".".$col;
      }
    }
    elseif($alias_infos=$this->graph_term2alias[$var]){
      $alias=$alias_infos[0]["alias"];
      $tbl_alias="V".$alias."_g";
      //$result.=strlen($result) ? ", \n " : "\n ";
      $result.=$tbl_alias.".val";
    }
    
    return $result;
  }
  
  function get_expression_order_by_code($cond=""){
    $result="";
    $expr=$cond["expression"];
    $expr_type=$expr["type"];
    $mthd="get_".$expr_type."_order_by_code";
    if(method_exists($this, $mthd)){
      $result.=$this->${mthd}($expr);
    }
    if($result && ($dir=$cond["direction"])){
      $result.=" ".rawurlencode(strtoupper($dir));
    }
    return $result;
  }
    
  /*          */

  function get_limit_offset_code(){
    $result="";
    $offset=($this->infos["offset"]) ? $this->infos["offset"] : 0;
    $limit=($this->infos["limit"]) ? $this->infos["limit"] : 0;
    if($limit){
      $result="\nLIMIT ".rawurlencode($offset).",".rawurlencode($limit);
    }
    elseif($offset){
      $result="\nOFFSET ".rawurlencode($offset);
    }
    return $result;
  }
  
  /*          */
  
  function get_graph_code(){
    $result="";
    $added_joins=array();
    foreach($this->graphs as $alias=>$graph){
      $graph_type=$graph["type"];
      $graph_val=$graph["val"];
      if($graph_type=="iri"){
        $result.=strlen($result) ? "\n AND " : "";
        $result.="T".$alias.".g='".$this->get_hash($graph_val)."'";
        $result.=" /* ".str_replace("*", "", str_replace("#", "::", htmlspecialchars($graph_val)))." */ ";
      }
      elseif($graph_type=="var"){
        /* graph joins */
        $alias_infos=$this->graph_term2alias[$graph_val];
        $alias_1=$alias_infos[0]["alias"];
        for($i=1,$i_max=count($alias_infos);$i<$i_max;$i++){
          $cur_alias_info=$alias_infos[$i];
          $cur_alias=$cur_alias_info["alias"];
          $cur_join="T".$alias_1.".g=T".$cur_alias.".g";
          if(($alias_1!=$cur_alias) && !in_array($cur_join, $added_joins)){
            $result.=strlen($result) ? "\n AND " : "";
            $result.=$cur_join;
            $added_joins[]=$cur_join;
          }
        }
        /* graph occurences in triple patterns */
        if($alias_infos=$this->term2alias[$graph_val]){
          $alias_info=$alias_infos[0];
          $alias=$alias_info["alias"];
          $col=$alias_info["col"];
          $cur_join="T".$alias_1.".g=T".$alias.".".$col;
          if(($alias_1!=$alias) && !in_array($cur_join, $added_joins)){
            $result.=strlen($result) ? "\n AND " : "";
            $result.=$cur_join;
            $added_joins[]=$cur_join;
          }
        }
      }
    }
    return $result;
  }
  
  function get_dataset_code($for_optionals=false, $exact_alias=false){
    $result="";
    $added_aliases=array();
    $sets=$this->infos["datasets"];
    $n_sets=$this->infos["named_datasets"];
    if(!count($sets) && !count($n_sets)){
      return $result;
    }
    /* non-graph'd patterns */
    foreach($this->non_graph_aliases as $cur_alias){
      $sub_result="";
      if(!$exact_alias || ($exact_alias==$cur_alias)){
        if((!$for_optionals && !in_array($cur_alias, $this->optional_t_counts)) || ($for_optionals && in_array($cur_alias, $this->optional_t_counts))){
          /* datasets */
          foreach($sets as $cur_set){
            $sub_result.=strlen($sub_result) ? "\n  OR " : " ";
            $sub_result.="T".$cur_alias.".g='".$this->get_hash($cur_set)."'";
            $sub_result.=" /* ".str_replace("*", "", str_replace("#", "::", htmlspecialchars($cur_set)))." */ ";
          }
        }
      }
      if($sub_result){
        $result.=strlen($result) ? "\n AND " : " ";
        $result.="(".$sub_result.")";
      }
    }
    /* graph'd patterns */
    foreach($this->graphs as $cur_alias=>$graph){
      $graph_type=$graph["type"];
      $graph_val=$graph["val"];
      if(!$exact_alias || ($exact_alias==$cur_alias)){
        if(($graph_type=="var") && (!$for_optionals && !in_array($cur_alias, $this->optional_t_counts)) || ($for_optionals && in_array($cur_alias, $this->optional_t_counts))){
          $sub_result="";
          /* named datasets, if set */
          if(($my_sets=$n_sets) || ($my_sets=$sets)){
            foreach($my_sets as $cur_set){
              $sub_result.=strlen($sub_result) ? "\n  OR " : " ";
              $sub_result.="T".$cur_alias.".g='".$this->get_hash($cur_set)."'";
              $sub_result.=" /* ".str_replace("*", "", str_replace("#", "::", htmlspecialchars($cur_set)))." */ ";
            }
          }
          if($sub_result){
            $result.=strlen($result) ? "\n AND " : " ";
            $result.="(".$sub_result.")";
          }
        }
      }
    }
    return $result;
  }
  
  /*          */

  function parse_patterns(){
    $infos=$this->infos;
    $where_code="";
    $this->t_count=0;
    $this->optional_count=0;
    $this->union_count=0;/* abs union count */
    $this->term2alias=array();
    $this->alias2term=array();
    $this->optional_term2alias=array();
    $this->optional_t_counts=array();
    $this->optional_patterns=array();
    $this->union_t_counts=array();/* individual t_counts for each union branch */
    $this->union_branches=array();
    $this->graphs=array();
    $this->graph_term2alias=array();
    $this->non_graph_aliases=array();
    $this->alias_alternatives=array();/* for peer optionals with common terms */
    $this->val_match_vars=array();/* for REGEX matching */
    $this->alias_prop_infos=array();
    $this->var_col_occurs=array();/* col positions (s,p,o) a var is used (needed to detect obj_props for table splitting) */
    $ind=" ";
    foreach($infos["patterns"] as $cur_pattern){
      $cur_args=array(
        "ind"=>$ind,
        "in_optional"=>false,
        "optional_count"=>0,
        "parent_optional_count"=>0,
        "in_union"=>false,
        "union_count"=>0,
        "union_branch_id"=>"",
        "in_graph"=>false,
        "graph"=>array(),
        "pattern"=>""
      );
      $cur_type=$cur_pattern["type"];
      if(!$cur_type){
        foreach($cur_pattern as $cur_sub_pattern){
          $cur_type=$cur_sub_pattern["type"];
          if(!$cur_type && ($cur_type=$cur_sub_pattern[0]["type"])){
            $cur_sub_pattern=$cur_sub_pattern[0];
          }
          if($cur_type){
            $cur_args["pattern"]=$cur_sub_pattern;
            $mthd="parse_".$cur_type."_pattern";
            if(method_exists($this, $mthd)){
              if($sub_code=$this->${mthd}($cur_args)){
                $where_code.=(strlen($where_code)) ? "\n".$ind."AND\n".$ind."(\n ".str_replace("\n", "\n ", $sub_code)."\n".$ind.")" : $sub_code;
              }
            }
          }
        }
      }
      else{
        $cur_args["pattern"]=$cur_pattern;
        $mthd="parse_".$cur_type."_pattern";
        if(method_exists($this, $mthd)){
          if($sub_code=$this->${mthd}($cur_args)){
            $where_code.=(strlen($where_code)) ? "\n".$ind."AND\n".$ind."(\n ".str_replace("\n", "\n ", $sub_code)."\n".$ind.")" : $sub_code;
          }
        }
      }
    }
    $this->where_code=$where_code;
  }
  
  /*          */
  
  function parse_group_pattern($args=""){
    $result="";
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    if($entries=$pattern["entries"]){
      foreach($entries as $cur_pattern){
        $cur_type=$cur_pattern["type"];
        if(!$cur_type){
          $cur_pattern=$cur_pattern[0];
          $cur_type=$cur_pattern["type"];
        }
        $cur_args=array(
          "ind"=>$ind." ",
          "in_optional"=>$in_optional,
          "optional_count"=>$optional_count,
          "parent_optional_count"=>$parent_optional_count,
          "in_union"=>$in_union,
          "union_count"=>$union_count,
          "union_branch_id"=>$union_branch_id,
          "in_graph"=>$in_graph,
          "graph"=>$graph,
          "pattern"=>$cur_pattern
        );
        $mthd="parse_".$cur_type."_pattern";
        if(method_exists($this, $mthd)){
          if($sub_code=$this->${mthd}($cur_args)){
            $result.=(strlen($result)) ? "\n".$ind."AND\n".$ind."(\n ".str_replace("\n", "\n ", $sub_code)."\n".$ind.")" : $sub_code;
          }
        }
      }
    }
    return (strlen($result)) ? $ind."(\n".$result."\n".$ind.")" : "";
  }

  /*          */
  
  function parse_graph_pattern($args=""){
    $result="";
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    $cur_pattern=$pattern["pattern"];
    $cur_type=$cur_pattern["type"];
    if(!$cur_type){
      $cur_pattern=$cur_pattern[0];
      $cur_type=$cur_pattern["type"];
    }
    $cur_args=array(
      "ind"=>$ind." ",
      "in_optional"=>$in_optional,
      "optional_count"=>$optional_count,
      "parent_optional_count"=>$parent_optional_count,
      "in_union"=>$in_union,
      "union_count"=>$union_count,
      "union_branch_id"=>$union_branch_id,
      "in_graph"=>true,
      "graph"=>$pattern["graph"],
      "pattern"=>$cur_pattern
    );
    $mthd="parse_".$cur_type."_pattern";
    if(method_exists($this, $mthd)){
      if($sub_code=$this->${mthd}($cur_args)){
        $result.=(strlen($result)) ? "\n".$ind."AND\n".$ind."(\n ".str_replace("\n", "\n ", $sub_code)."\n".$ind.")" : $sub_code;
      }
    }
    return (strlen($result)) ? $ind."(\n".$result."\n".$ind.")" : "";
  }

  /*          */

  function parse_triples_pattern($args=""){
    $result="";
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    if($triples=$pattern["triples"]){
      foreach($triples as $cur_t){
        if(!$in_union){
          $this->t_count++;
          $cur_t_count=$this->t_count;
        }
        else{
          $this->union_t_counts[$union_branch_id]++;
          $cur_t_count=$this->union_t_counts[$union_branch_id];
        }
        $tbl_alias="T".$cur_t_count;
        if($in_optional && !in_array($cur_t_count, $this->optional_t_counts)){
          $this->optional_t_counts[]=$cur_t_count;
          $this->logs[]="adding ".$cur_t_count." to optional_t_counts";
        }
        if($in_graph){
          $this->graphs[$cur_t_count]=$graph;
          if($graph["type"]=="var"){
            $graph_val=$graph["val"];
            if(!isset($this->graph_term2alias[$graph_val])){
              $this->graph_term2alias[$graph_val]=array();
            }
            $this->graph_term2alias[$graph_val][]=array("alias"=>$cur_t_count);
          }
        }
        elseif(!in_array($cur_t_count, $this->non_graph_aliases)){
          $this->non_graph_aliases[]=$cur_t_count;
        }
        $this->alias_prop_infos[$cur_t_count]=array("in_graph"=>$in_graph);
        foreach(array("s", "p", "o") as $cur_col){
          $cur_term=$cur_t[$cur_col];
          $cur_term_type=$cur_term["type"];
          $cur_term_val=$cur_term["val"];
          $sub_result="";
          if($cur_col=="p"){
            $this->alias_prop_infos[$cur_t_count]["p_term_type"]=$cur_term_type;
            $this->alias_prop_infos[$cur_t_count]["p_term_val"]=$cur_term_val;
          }
          if($cur_col=="o"){
            $this->alias_prop_infos[$cur_t_count]["o_term_type"]=$cur_term_type;
            $this->alias_prop_infos[$cur_t_count]["o_term_val"]=$cur_term_val;
          }
          if($cur_term_type=="iri"){
            $sub_result.="(\n".$ind;
            $sub_result.=" ".$tbl_alias.".".$cur_col."='".$this->get_hash($cur_term_val)."'";
            $sub_result.=" /* ".str_replace("*", "", str_replace("#", "::", htmlspecialchars($cur_term_val)))." */ ";
            /* iri alternatives expansion */
            if(isset($this->iri_alts) && ($iri_alts=$this->iri_alts[$cur_term_val])){
              foreach($iri_alts as $cur_iri_alt){
                $sub_result.="\n".$ind."OR ";
                $sub_result.=" ".$tbl_alias.".".$cur_col."='".$this->get_hash($cur_iri_alt)."'";
                $sub_result.=" /* ".str_replace("*", "", str_replace("#", "::", htmlspecialchars($cur_iri_alt)))." */ ";
              }
            }
            $sub_result.="\n".$ind.")";
          }
          elseif($cur_term_type=="literal"){
            $sub_result.="(\n".$ind;
            $sub_result.=" ".$tbl_alias.".".$cur_col."='".$this->get_hash($cur_term_val)."'";
            $sub_result.=" /* ".str_replace("*", "", str_replace("#", "::", htmlspecialchars($cur_term_val)))." */ ";
            $sub_result.="\n".$ind.")";
          }
          else{
            if($cur_term_type=="bnode"){
              //$cur_term_val=str_replace(":", "_", $cur_term_val);
            }
            /* term2alias/optional_term2alias */
            $term2alias_array=($in_optional) ? "optional_term2alias" : "term2alias";
            if(!isset($this->$term2alias_array[$cur_term_val])){
              $this->$term2alias_array[$cur_term_val]=array();
            }
            eval('$this->'.$term2alias_array.'[$cur_term_val][]=array("alias"=>$cur_t_count, "col"=>$cur_col, "term"=>$cur_term, "optional_count"=>$optional_count, "parent_optional_count"=>$parent_optional_count, "union_branch_id"=>$union_branch_id, "in_graph"=>$in_graph, "graph"=>$graph);');
            /* alias2term */
            if(!isset($this->alias2term[$cur_t_count])){
              $this->alias2term[$cur_t_count]=array();
            }
            $this->alias2term[$cur_t_count][]=array("term"=>$cur_term, "col"=>$cur_col);
            /* col occurrence */
            if(!isset($this->var_col_occurs[$cur_term_val])){
              $this->var_col_occurs[$cur_term_val]=array();
            }
            $this->var_col_occurs[$cur_term_val][]=$cur_col;
          }
          if($sub_result){
            if($in_optional){
              if(!isset($this->optional_patterns[$tbl_alias])){
                $this->optional_patterns[$tbl_alias]=array();
              }
              $this->optional_patterns[$tbl_alias][]=$sub_result;
              $this->logs[]="adding ".$sub_result." to optional_patterns[".$tbl_alias."]";
            }
            else{
              $result.=(strlen($result)) ? "\n".$ind."AND\n".$ind : "".$ind;
              $result.=$sub_result;
            }
          }
        }
      }
    }
    return $result;
  }
  
  /*          */

  function parse_optional_pattern($args=""){
    $result="";
    $optional_count=0;
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    if($cur_pattern=$pattern["pattern"]){
      $cur_type=$cur_pattern["type"];
      if(!$cur_type){
        $cur_pattern=$cur_pattern[0];
        $cur_type=$cur_pattern["type"];
      }
      $this->optional_count++;
      $cur_args=array(
        "ind"=>$ind." ",
        "in_optional"=>true,
        "optional_count"=>$this->optional_count,
        "parent_optional_count"=>$optional_count,
        "in_union"=>$in_union,
        "union_count"=>$union_count,
        "union_branch_id"=>$union_branch_id,
        "pattern"=>$cur_pattern
      );
      $mthd="parse_".$cur_type."_pattern";
      if(method_exists($this, $mthd)){
        if($sub_code=$this->${mthd}($cur_args)){
          $result.=(strlen($result)) ? "\n".$ind."AND\n".$ind."(\n".str_replace("\n", "\n ", $sub_code)."\n".$ind.")" : $sub_code;
        }
      }
    }
    return (strlen($result)) ? $ind."(\n".$result."\n".$ind.")" : "";
  }

  /*          */

  function parse_union_pattern($args=""){
    $result="";
    $union_count=0;
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    if($entries=$pattern["entries"]){
      $this->union_count++;
      $base_t_count=100+$this->t_count;
      if(!array_key_exists("base_t_count", $this->union_t_counts)){
        $this->union_t_counts["base_t_count"]=$base_t_count;
      }
      $pos=0;
      $this->union_branches[$this->union_count]=array();
      foreach($entries as $cur_pattern){
        $cur_type=$cur_pattern["type"];
        if(!$cur_type){
          $cur_pattern=$cur_pattern[0];
          $cur_type=$cur_pattern["type"];
        }
        $pos++;
        $union_branch_id=$this->union_count."_".$pos;
        $this->union_t_counts[$union_branch_id]=$base_t_count;
        
        $cur_args=array(
          "ind"=>$ind." ",
          "in_optional"=>$in_optional,
          "optional_count"=>$optional_count,
          "parent_optional_count"=>$parent_optional_count,
          "in_union"=>true,
          "union_count"=>$this->union_count,
          "union_branch_id"=>$union_branch_id,
          "pattern"=>$cur_pattern
        );
        $mthd="parse_".$cur_type."_pattern";
        if(method_exists($this, $mthd)){
          if($sub_code=$this->${mthd}($cur_args)){
            $this->union_branches[$this->union_count][]=$sub_code;
            $result.=(strlen($result)) ? "" : "__union_".$this->union_count."__";
            //$result.=(strlen($result)) ? "\n".$ind."OR\n".$ind."(\n ".str_replace("\n", "\n ", $sub_code)."\n".$ind.")" : $sub_code;
          }
        }
      }
    }
    return (strlen($result)) ? $ind."(\n".$result."\n".$ind.")" : "";
  }
  
  /*          */
  
  function parse_filter_pattern($args){
    $result="";
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    if($sub_type=$pattern["sub_type"]){
      $cur_args=array(
        "ind"=>$ind." ",
        "in_optional"=>$in_optional,
        "optional_count"=>$optional_count,
        "parent_optional_count"=>$parent_optional_count,
        "in_union"=>$in_union,
        "union_count"=>$union_count,
        "union_branch_id"=>$union_branch_id,
        "pattern"=>$pattern
      );
      $mthd="parse_".$sub_type."_filter_pattern";
      if(method_exists($this, $mthd)){
        if($sub_code=$this->${mthd}($cur_args)){
          $result.=(strlen($result)) ? "\n".$ind."AND\n".$ind."(\n".str_replace("\n", "\n ", $sub_code)."\n".$ind.")" : $sub_code;
        }
      }
    }
    return $result;;
  }
  
  function parse_expression_filter_pattern($args){
    $result="";
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    /* for now: some hard-coded expressions only */
    if(($exprs=$pattern["expressions"]) || ($exprs=$pattern["expression"])){
      /* ?var <|> numeric|literal */
      if((count($exprs)==2) 
        && ($exprs[0]["type"]=="var")
        && ($var_val=$exprs[0]["val"])
        && ($expr_2_type=$exprs[1]["type"])
        && (in_array($expr_2_type, array("numeric", "literal")))
        && ($literal_val=$exprs[1]["val"])
        && ($operator=$exprs[1]["operator"])
        && (in_array($operator, array("<", ">", "<=", ">=")))
      ){
        /* var */
        if(($alias_infos=$this->term2alias[$var_val]) || ($alias_infos=$this->optional_term2alias[$var_val]) || ($alias_infos=$this->graph_term2alias[$var_val])){
          $alias_info=$alias_infos[0];
          $alias=$alias_info["alias"];
          $col=$alias_info["col"];
          $tbl_code=($col=="o") ? "T".$alias.".o_comp" : "V".$alias.".".$col;
          $result.=(is_numeric($literal_val)) ? "CAST (".$tbl_code." AS SIGNED) +0.00" : $tbl_code;
        }
        /* operator */
        $result.=(strlen($result)) ? " ".$operator." " : "";
        /* literal */
        if($result){
          if(is_numeric($literal_val)){
            $result.=(($modifier=$exprs[1]["modifier"]) && ($modifier=="-")) ? $modifier : "";
            $result.=$literal_val;
          }
          elseif($delim_code=$exprs[1]["delim_code"]){
            $delim_code_char=$delim_code{0};
            $result.=$delim_code_char.str_replace($delim_code_char, "", $literal_val).$delim_code_char;
          }
        }
      }
      /* built_in_calls */
      if(($expr=$pattern["expression"]) && ($expr["type"]=="built_in_call")){
        $mthd="parse_built_in_call_filter_pattern";
        if(method_exists($this, $mthd)){
          if($sub_code=$this->${mthd}(array("pattern"=>$expr))){
            $result.=$sub_code;
          }
        }
      }
      /* result */
      if(!$in_optional){
        return (strlen($result)) ? $ind.$result : $result;
      }
      elseif(strlen($result)){
        /* add to optional patterns for left joins */
        if(($alias_infos=$this->term2alias[$var_val]) || ($alias_infos=$this->optional_term2alias[$var_val])){
          $alias_info=$alias_infos[0];
          $alias=$alias_info["alias"];
          $tbl_alias="T".$alias;
          if(!isset($this->optional_patterns[$tbl_alias])){
            $this->optional_patterns[$tbl_alias]=array();
          }
          $this->optional_patterns[$tbl_alias][]="(\n".$ind.$result."\n".substr($ind, 0, -1).")";
        }
      }
    }
    return "";
  }

  /*          */

  function parse_built_in_call_filter_pattern($args=""){
    $result="";
    $call="";
    if(is_array($args)){foreach($args as $k=>$v){$$k=$v;}}
    if(is_array($pattern["call"])){
      $pattern=$pattern["call"];
    }
    if(is_array($pattern)){foreach($pattern as $k=>$v){$$k=$v;}}
    /* bound */
    if(($call=="bound") && $var){
      if($alias_infos=$this->optional_term2alias[$var]){
        $alias_info=$alias_infos[0];
        $alias=$alias_info["alias"];
        $col=$alias_info["col"];
        $result.=($modifier=="!") ? "T".$alias.".".$col." IS NULL" : "T".$alias.".".$col." IS NOT NULL";
      }
    }
    /* isIRI/isURI */
    if(in_array($call, array("isiri", "isuri")) && ($expr=$expression) && ($expr["type"]=="var") && ($var_val=$expr["val"])){
      if(($alias_infos=$this->term2alias[$var_val]) || ($alias_infos=$this->optional_term2alias[$var_val])){
        $alias_info=$alias_infos[0];
        $alias=$alias_info["alias"];
        $col=$alias_info["col"];
        if($col=="p"){
          /* p is always an IRI */
          if($alias_info["optional_count"]){
            $result.=($expr["modifier"]=="!") ? "(T".$alias.".".$col." IS NULL OR 0)" : "";
          }
          else{
            $result.=($expr["modifier"]=="!") ? "0" : "";
          }
        }
        else{
          if($alias_info["optional_count"]){
            $result.=($expr["modifier"]=="!") ? "(T".$alias.".".$col." IS NULL OR NOT (T".$alias.".".$col."_type=0))" : "(T".$alias.".".$col." IS NULL OR T".$alias.".".$col."_type=0)";
          }
          else{
            $result.=($expr["modifier"]=="!") ? " NOT (T".$alias.".".$col."_type=0)" : " T".$alias.".".$col."_type=0";
          }
        }
      }
    }
    /* isBlank */
    if(in_array($call, array("isblank")) && ($expr=$expression) && ($expr["type"]=="var") && ($var_val=$expr["val"])){
      if(($alias_infos=$this->term2alias[$var_val]) || ($alias_infos=$this->optional_term2alias[$var_val])){
        $alias_info=$alias_infos[0];
        $alias=$alias_info["alias"];
        $col=$alias_info["col"];
        if($col=="p"){
          /* p is never a bnode */
          if($alias_info["optional_count"]){
            $result.=($expr["modifier"]=="!") ? "" : "(T".$alias.".".$col." IS NULL OR 0)";
          }
          else{
            $result.=($expr["modifier"]=="!") ? "" : "0";
          }
        }
        else{
          if($alias_info["optional_count"]){
            $result.=($expr["modifier"]=="!") ? "(T".$alias.".".$col." IS NULL OR NOT (T".$alias.".".$col."_type=1))" : "(T".$alias.".".$col." IS NULL OR T".$alias.".".$col."_type=1)";
          }
          else{
            $result.=($expr["modifier"]=="!") ? " NOT (T".$alias.".".$col."_type=1)" : " T".$alias.".".$col."_type=1";
          }
        }
      }
    }
    /* isLiteral */
    if(in_array($call, array("isliteral")) && ($expr=$expression) && ($expr["type"]=="var") && ($var_val=$expr["val"])){
      if(($alias_infos=$this->term2alias[$var_val]) || ($alias_infos=$this->optional_term2alias[$var_val])){
        $alias_info=$alias_infos[0];
        $alias=$alias_info["alias"];
        $col=$alias_info["col"];
        if($col=="p"){
          /* p is never a literal */
          if($alias_info["optional_count"]){
            $result.=($expr["modifier"]=="!") ? "" : "(T".$alias.".".$col." IS NULL OR 0)";
          }
          else{
            $result.=($expr["modifier"]=="!") ? "" : "0";
          }
        }
        else{
          if($alias_info["optional_count"]){
            $result.=($expr["modifier"]=="!") ? "(T".$alias.".".$col." IS NULL OR (T".$alias.".".$col."_type < 2))" : "(T".$alias.".".$col." IS NULL OR T".$alias.".".$col."_type > 1)";
          }
          else{
            $result.=($expr["modifier"]=="!") ? "(T".$alias.".".$col."_type < 2)" : " T".$alias.".".$col."_type > 1";
          }
        }
      }
    }
    /* regex */
    if(($call="regex") && ($exprs=$expressions) && ((count($exprs)==3) || (count($exprs)==2))){
      $sub_result="";
      /* expr 1 */
      $expr_1=$exprs[0];
      if($expr_1["call"] && ($expr_1["call"]=="str")){
        $expr_1=$expr_1["expression"];
      }
      if(($expr_1["type"]=="var") 
        && ($var_val=$expr_1["val"])
        && ($expr_2=$exprs[1])
        && ($expr_2["type"]=="literal")
        && ($match_val=$expr_2["val"])
      ){
        $use_like=false;
        $prefix="";
        $suffix="";
        $sql_snippet="";
        if(preg_match("/^([\^]?)([a-z0-9_\-\@ \:\.,]+)([\$]?)$/i", $match_val, $matches)){/* simple string search */
          $use_like=true;
          $prefix=($matches[1]=='^') ? "" : "%";
          $suffix=($matches[3]=='$') ? "" : "%";
          $match_val=$matches[2];
          $match_val=(substr($match_val, 0, 1)=='%') ? "\\".$match_val : $match_val;/* escape leading % */
          $match_val=(substr($match_val, 0, 1)=='_') ? "\\".$match_val : $match_val;/* escape leading _ */
          $sql_snippet=($this->encode_values) ? "LIKE '".$prefix.rawurlencode($match_val).$suffix."'" : "LIKE '".$prefix.$match_val.$suffix."'";
        }
        else{
          $match_val=str_replace("'", "\'", $match_val);
          $match_val=str_replace("\\'", "\'", $match_val);
          $sql_snippet="REGEXP '".$match_val."'";/* won't work in most cases if "val" column values are urlencoded */
        }
        if(($alias_infos=$this->term2alias[$var_val]) || ($alias_infos=$this->optional_term2alias[$var_val])){
          $alias_info=$alias_infos[0];
          $alias=$alias_info["alias"];
          $col=$alias_info["col"];
          $sub_result="V__regex_match_".$var_val."__.val ".$sql_snippet;
          $result.=($modifier && ($modifier=="!")) ? " NOT (".$sub_result.")" : " ".$sub_result;
          $this->val_match_vars[]=$var_val;
        }
      }
    }
    return $result;
  }

  /*          */

}

?>