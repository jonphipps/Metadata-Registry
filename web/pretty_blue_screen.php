<?php
set_exception_handler('PrettyBlueScreen');

function PrettyBlueScreen($e) {
  $o = create_function('$in','echo htmlspecialchars($in);');
  $sub = create_function('$f','$loc="";if(isset($f["class"])){
    $loc.=$f["class"].$f["type"];}
    if(isset($f["function"])){$loc.=$f["function"];}
    if(!empty($loc)){$loc=htmlspecialchars($loc);
    $loc="<strong>$loc</strong>";}return $loc;');
  $parms = create_function('$f','$params=array();if(isset($f["function"])){
    try{if(isset($f["class"])){
    $r=new ReflectionMethod($f["class"]."::".$f["function"]);}
    else{$r=new ReflectionFunction($f["function"]);}
    return $r->getParameters();}catch(Exception $e){}}
    return $params;');
  $src2lines = create_function('$file','$src=nl2br(highlight_file($file,TRUE));
    return explode("<br />",$src);');
  $clean = create_function('$line','return trim(strip_tags($line));');
  $desc = get_class($e)." making ".$_SERVER['REQUEST_METHOD']." request to ".
    $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="robots" content="NONE,NOARCHIVE" />
  <title><?php $o($desc);?></title>
  <style type="text/css">
    html * { padding:0; margin:0; }
    body * { padding:10px 20px; }
    body * * { padding:0; }
    body { font:small sans-serif; background: #70DBFF; }
    body>div { border-bottom:1px solid #ddd; }
    h1 { font-weight:normal; }
    h2 { margin-bottom:.8em; }
    h2 span { font-size:80%; color:#666; font-weight:normal; }
    h2 a { text-decoration:none; }
    h3 { margin:1em 0 .5em 0; }
    h4 { margin:0.5em 0 .5em 0; font-weight: normal; font-style: italic; }
    table {
        border:1px solid #ccc; border-collapse: collapse; background:white; }
    tbody td, tbody th { vertical-align:top; padding:2px 3px; }
    thead th {
        padding:1px 6px 1px 3px; background:#70FF94; text-align:left;
        font-weight:bold; font-size:11px; border:1px solid #ddd; }
    tbody th { text-align:right; color:#666; padding-right:.5em; }
    table.vars { margin:5px 0 2px 40px; }
    table.vars td, table.req td { font-family:monospace; }
    table td { background: #70FFDB; }
    table td.code { width:95%;}
    table td.code div { overflow:hidden; }
    table.source th { color:#666; }
    table.source td {
        font-family:monospace; white-space:pre; border-bottom:1px solid #eee; }
    ul.traceback { list-style-type:none; }
    ul.traceback li.frame { margin-bottom:1em; }
    div.context { margin:5px 0 2px 40px; background-color:#70FFDB; }
    div.context ol {
        padding-left:30px; margin:0 10px; list-style-position: inside; }
    div.context ol li {
        font-family:monospace; white-space:pre; color:#666; cursor:pointer; }
    div.context li.current-line { color:black; background-color:#70FF94; }
    div.commands { margin-left: 40px; }
    div.commands a { color:black; text-decoration:none; }
    p.headers { background: #70FFDB; font-family:monospace; }
    #summary { background: #00B8F5; }
    #summary h2 { font-weight: normal; color: #666; }
    #traceback { background:#eee; }
    #request { background:#f6f6f6; }
    #response { background:#eee; }
    #summary table { border:none; background:#00B8F5; }
    #summary td  { background:#00B8F5; }
    .switch { text-decoration: none; }
    .whitemsg { background:white; color:black;}
  </style>
  <script type="text/javascript">
  //<!--
    function getElementsByClassName(oElm, strTagName, strClassName){
        // Written by Jonathan Snook, http://www.snook.ca/jon;
        // Add-ons by Robert Nyman, http://www.robertnyman.com
        var arrElements = (strTagName == "*" && document.all)? document.all :
        oElm.getElementsByTagName(strTagName);
        var arrReturnElements = new Array();
        strClassName = strClassName.replace(/\-/g, "\\-");
        var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
        var oElement;
        for(var i=0; i<arrElements.length; i++){
            oElement = arrElements[i];
            if(oRegExp.test(oElement.className)){
                arrReturnElements.push(oElement);
            }
        }
        return (arrReturnElements)
    }
    function hideAll(elems) {
      for (var e = 0; e < elems.length; e++) {
        elems[e].style.display = 'none';
      }
    }
    function toggle() {
      for (var i = 0; i < arguments.length; i++) {
        var e = document.getElementById(arguments[i]);
        if (e) {
          e.style.display = e.style.display == 'none' ? 'block' : 'none';
        }
      }
      return false;
    }
    function varToggle(link, id, prefix) {
      toggle(prefix + id);
      var s = link.getElementsByTagName('span')[0];
      var uarr = String.fromCharCode(0x25b6);
      var darr = String.fromCharCode(0x25bc);
      s.innerHTML = s.innerHTML == uarr ? darr : uarr;
      return false;
    }
    function sectionToggle(span, section) {
      toggle(section);
      var span = document.getElementById(span);
      var uarr = String.fromCharCode(0x25b6);
      var darr = String.fromCharCode(0x25bc);
      span.innerHTML = span.innerHTML == uarr ? darr : uarr;
      return false;
    }

    window.onload = function() {
      hideAll(getElementsByClassName(document, 'table', 'vars'));
      hideAll(getElementsByClassName(document, 'div', 'context'));
      hideAll(getElementsByClassName(document, 'ul', 'traceback'));
      hideAll(getElementsByClassName(document, 'div', 'section'));
    }
    //-->
  </script>
</head>
<body>

<div id="summary">
  <h1><?php $o($desc);?></h1>
  <h2><?php
    if ( $e->getCode() ) { $o($e->getCode()). ' : '; }
    ?> <?php $o($e->getMessage()); ?></h2>
  <table>
    <tr>
      <th>PHP</th>
      <td><?php $o($e->getFile()); ?>, line <?php $o($e->getLine()); ?></td>
    </tr>
    <tr>
      <th>URI</th>
      <td><?php $o($_SERVER['REQUEST_METHOD'].' '.
        $_SERVER['REQUEST_URI']);?></td>
    </tr>
  </table>
</div>

<div id="traceback">
  <h2>Stacktrace
    <a href='#' onclick="return sectionToggle('tb_switch','tb_list')">
    <span id="tb_switch">?</span></a></h2>
  <ul id="tb_list" class="traceback">
    <?php $frames = $e->getTrace(); foreach ( $frames as $frame_id => $frame ) { ?>
      <li class="frame">
        <?php echo $sub($frame); ?>
        [<?php $o($frame['file']); ?>, line <?php $o($frame['line']);?>]
        <?php
        if ( count($frame['args']) > 0 ) {
          $params = $parms($frame);
        ?>
          <div class="commands">
              <a href='#' onclick="return varToggle(this, '<?php
              $o($frame_id); ?>','v')"><span>?</span> Args</a>
          </div>
          <table class="vars" id="v<?php $o($frame_id); ?>">
            <thead>
              <tr>
                <th>Arg</th>
                <th>Name</th>
                <th>Value</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach ( $frame['args'] as $k => $v ) {
                  $name = isset($params[$k]) ? '$'.$params[$k]->name : '?';
                ?>
                <tr>
                  <td><?php $o($k); ?></td>
                  <td><?php $o($name);?></td>
                  <td class="code">
                    <div><?php highlight_string(var_export($v,TRUE));?></div>
                  </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
          </table>
        <?php } if ( is_readable($frame['file']) ) { ?>
        <div class="commands">
            <a href='#' onclick="return varToggle(this, '<?php
            $o($frame_id); ?>','c')"><span>?</span> Src</a>
        </div>
        <div class="context" id="c<?php $o($frame_id); ?>">
          <?php
          $lines = $src2lines($frame['file']);
          $start = $frame['line'] < 5 ?
            0 : $frame['line'] -5; $end = $start + 10;
          $out = '';
          foreach ( $lines as $k => $line ) {
            if ( $k > $end ) { break; }
            $line = trim(strip_tags($line));
            if ( $k < $start && isset($frames[$frame_id+1]["function"])
              && preg_match(
                '/function( )*'.preg_quote($frames[$frame_id+1]["function"]).'/',
                  $line) ) {
              $start = $k;
            }
            if ( $k >= $start ) {
              if ( $k != $frame['line'] ) {
                $out .= '<li><code>'.$clean($line).'</code></li>'."\n"; }
              else {
                $out .= '<li class="current-line"><code>'.
                  $clean($line).'</code></li>'."\n"; }
            }
          }
          echo "<ol start=\"$start\">\n".$out. "</ol>\n";
          ?>
        </div>
        <?php } else { ?>
        <div class="commands">No src available</div>
        <?php } ?>
      </li>
    <?php } ?>
  </ul>

</div>

<div id="request">
  <h2>Request
    <a href='#' onclick="return sectionToggle('req_switch','req_list')">
    <span id="req_switch">?</span></a></h2>
  <div id="req_list" class="section">
    <?php
    if ( function_exists('apache_request_headers') ) {
    ?>
    <h3>Request <span>(raw)</span></h3>
    <?php
      $req_headers = apache_request_headers();
        ?>
      <h4>HEADERS</h4>
      <?php
      if ( count($req_headers) > 0 ) {
      ?>
        <p class="headers">
        <?php
        foreach ( $req_headers as $req_h_name => $req_h_val ) {
          $o($req_h_name.': '.$req_h_val);
          echo '<br>';
        }
        ?>

        </p>
      <?php } else { ?>
        <p>No headers.</p>
      <?php } ?>

      <?php
      $req_body = file_get_contents('php://input');
      if ( strlen( $req_body ) > 0 ) {
      ?>
      <h4>Body</h4>
      <p class="req" style="padding-bottom: 2em"><code>
        <?php $o($req_body); ?>
      </code></p>
      <?php } ?>
    <?php } ?>
    <h3>Request <span>(parsed)</span></h3>
    <?php
    $superglobals = array('$_GET','$_POST','$_COOKIE','$_SERVER','$_ENV');
    foreach ( $superglobals as $sglobal ) {
      $sfn = create_function('','return '.$sglobal.';');
    ?>
    <h4><?php echo $sglobal; ?></h4>
      <?php
      if ( count($sfn()) > 0 ) {
      ?>
      <table class="req">
        <thead>
          <tr>
            <th>Variable</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ( $sfn() as $k => $v ) {
          ?>
            <tr>
              <td><?php $o($k); ?></td>
              <td class="code">
                <div><?php $o(var_export($v,TRUE)); ?></div>
                </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } else { ?>
      <p class="whitemsg">No data</p>
      <?php } } ?>

  </div>
</div>

<?php if ( function_exists('headers_list') ) { ?>
<div id="response">

  <h2>Response
    <a href='#' onclick="return sectionToggle('resp_switch','resp_list')">
    <span id="resp_switch">?</span></a></h2>

  <div id="resp_list" class="section">

    <h3>Headers</h3>
    <?php
    $resp_headers = headers_list();
    if ( count($resp_headers) > 0 ) {
    ?>
    <p class="headers">
      <?php
      foreach ( $resp_headers as $resp_h ) {
        $o($resp_h);
        echo '<br>';
      }
      ?>
    </p>
    <?php } else { ?>
      <p>No headers.</p>
    <?php } ?>
</div>
<?php } ?>

</body>
</html>
<?php
}

