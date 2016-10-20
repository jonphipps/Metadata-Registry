<?php
if (isset($_GET['customUrl']))
{
  $Url = $_GET['customUrl'];
}
else
{
  $Url = 'rdaFull_7_7_09.xsd';
}

$displayOn = (isset($_POST['fileSubmit'])) ? false : true;
if ($displayOn):
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Create a Custom RDA Schema</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
  p, body, td, th, .txt {font-family: helvetica,arial,sans-serif; font-size: 90%; color: #003366;}
  .cpr {font-family: helvetica,arial,sans-serif; font-size: 60%; color: #000000;}
  .comp {font-family: helvetica,arial,sans-serif; font-size: 80%; color: #000000;}
  h1 {font-family: helvetica,arial,sans-serif; font-size: 150%; font-weight: 600; color: #003366;}
  h2 {font-family: helvetica,arial,sans-serif; color: #003366;}
  h3 {font-family: helvetica,arial,sans-serif; color: #003366;}
  p.mandatory { margin-top: 0px}
  form#getSchema { width: 630px; }
  div.form { border: medium solid; width: 600px; height: 500px; overflow: scroll; padding: 10px;}
  div.vocab { margin: 0 0 0 20px; padding: 0; }
  div.vocab strong { padding-top: 5px; }
  div.jquery { padding-left: 20px; }
  div.frbrDoc{ margin-left: 20px; }
  div.mandatory { margin-left: 20px; background-color: #faebd7; width: 200px; padding: 0px 0px 3px 5px;}
  .hidden { display: none; }
  </style>
  <link rel="stylesheet" type="text/css" href="css/checkboxtree.css" charset="utf-8" />
  <link rel="stylesheet" href="css/jquery.cluetip/jquery.cluetip.css" type="text/css" />

  <script src="js/jq/jquery-latest.js" type="text/javascript"></script>
  <script src="js/jq/jquery.checkboxtree.js" type="text/javascript"></script>
  <script src="js/jq/jquery.hoverIntent.js" type="text/javascript" ></script>
  <script src="js/jq/jquery.cluetip.js" type="text/javascript" ></script>

  <script type="text/javascript">
$(document).ready(function(){
  $('#showhidedoc_link').toggle(
      function() {
        $('.frbrDoc').addClass('hidden');
        $('#showhidedoc_link').html("Show Definitions");
      },
      function() {
        $('.frbrDoc').removeClass('hidden');
        $('#showhidedoc_link').html("Hide Definitions");
      });

      $('#showhidedoc_link').click();

  $('#showhidelim_link').toggle(
      function() {
        $('.mandatory').addClass('hidden');
        $('#showhidelim_link').html("Show Constraints");
      },
      function() {
        $('.mandatory').removeClass('hidden');
        //reset non-tree radio buttons
        $('div.mandatory input').show();
        $('div.mandatory label').css('background-image', 'none').css('padding','0');
       $('#showhidelim_link').html("Hide Constraints");
      });

      $('#showhidelim_link').click();

  $("#checkchildren").checkboxTree({
      collapsedarrow: "images/checkboxtree/img-arrow-collapsed.gif",
      expandedarrow: "images/checkboxtree/img-arrow-expanded.gif",
      blankarrow: "images/checkboxtree/img-arrow-blank.gif",
      checkchildren: true
  });

  //cluetip
  $('a.load-local').cluetip({local:true, hideLocal: false, arrows: true, cursor: 'pointer'});

});
</script>
</head>
<body>
<h1>Create a Custom RDA Schema</h1>

<form accept-charset="utf8" method="get" action="create_schema.php" name="getSchema" id="getSchema">
  <fieldset>
    <legend>Process this schema:</legend>
    <input type="text" maxlength="255" name="customUrl" id="customUrl" style="width: 520px;" value="<?php echo $Url ?>" />
    <input type="submit" name="urlSubmit" id="urlSubmit" value="Submit"/>
  </fieldset>
</form>

<?PHP
endif; //displayOn
//load the schema
try
{
  $rda = @new SimpleXMLElement($Url, null, true, 'xs', true);
}
catch (Exception $e)
{
$msg = $e->getMessage();
echo <<<EOT
<div class="error">
<h3>The schema you submitted could not be processed</h3>
<h4>Error: $msg</h4>
</div>
EOT;
}

//CHECK IF THERE'S AN ERROR
if (isset($rda)): //CAN load the schema
  if ($displayOn):  ?>
<form accept-charset="utf8" method="post" action="create_schema.php" name="processSchema" id="processSchema">
<div class="form">
<div style="text-align:right; margin:3px 10px; float:right; cursor: pointer;" title="Show/Hide all definitions" id="showhidedoc_link">Show Definitions</div><br clear="all" />
<div style="text-align:right; margin:3px 10px; float:right; cursor: pointer;" title="Show/Hide all constraints" id="showhidelim_link">Show Constraints</div>
<ul class="unorderedlisttree" id="checkchildren">
<?php
endif; //DisplayOn
/**
* Retrieves the definition documentation
*
* @return string
* @param  SimpleXMLElement $element The element that contains the doc
* @param  string $xpath The xpath to the doc
*/
function getDoc($element, $xpath) {
  $doc = $element->xpath($xpath);
  return ($doc) ? (string)$doc[0] : '';
}

/**
* Retrieves a vocabulary list from an element
*
* @return string Contains a dictionary list of the vocabulary
* @param  SimpleXMLElement $parentElement The element that contains the vocabulary
*/
function getVocabulary($parentElement) {
  $vocElements = $parentElement->xpath('xs:complexType/xs:simpleContent/xs:extension/xs:attribute/xs:simpleType/xs:restriction/xs:enumeration');
  if ($vocElements)
  {
    //get/display xs:complexType[1]/xs:simpleContent[1]/xs:extension[1]/xs:attribute[1]->name
    $att = $parentElement->xpath('xs:complexType/xs:simpleContent/xs:extension/xs:attribute');
    $vocabName = (string)$att[0]['name'];
    $html = "\n<div class=" . '"vocab"' . ">\n<strong><em>Recommended Vocabulary:</em> $vocabName</strong>\n<dl>\n";

    //for each enumeration
    foreach ($vocElements as $vocElement)
    {
      //get/display the value attribute
      $value = (string)$vocElement['value'];
      //get/display the documentation node
      $doc = getDoc($vocElement,'xs:annotation/xs:documentation');
      $html .= "  <dt>$value</dt>\n";
      $html .= ($doc) ? "    <dd>$doc</dd>\n" : '';
    } //end for each enumeration
    $html .= "</dl>\n</div>\n";
  } //end if $vocab

  return $html;
}

function deleteNode($element) {
    //note: http://www.kavoir.com/2008/12/how-to-delete-remove-nodes-in-simplexml.html
  //delete the node
  $oNode = dom_import_simplexml($element);
  $oNode->parentNode->removeChild($oNode);
  return $oNode;
}

$rdaSelected = $_POST;
$frbrElements = $rda->xpath('//xs:element[@name="RDARecord"]/xs:complexType/xs:sequence/xs:element');
$frbrDoc = getDoc($rda, '//xs:element[@name="RDARecord"]/xs:complexType/xs:annotation/xs:documentation');
//$frbrElements = $rda->xpath('/xs:schema/xs:element/xs:complexType/xs:sequence/descendant::xs:element');
//for each of the frbr elements
/** @var $element SimpleXMLElement **/
foreach ($frbrElements as $frbrElement):
  //get the attributes
  $frbrElementName = (string)$frbrElement['name'];
  $frbrElementType = (string)$frbrElement['type'];

  //get/display the frbrelement documentation
  $frbrElementDoc = getDoc($frbrElement, 'xs:annotation/xs:documentation');

  //get the complextype documentation
  $rdaElementsDoc = getDoc($rda, '//xs:complexType[@name="' . $frbrElementType . '"]/xs:sequence/xs:annotation/xs:documentation');
  //load the complex type of the element
  $rdaType = $rda->xpath('//xs:complexType[@name="' . $frbrElementType . '"]');
  $rdaElements = $rda->xpath('//xs:complexType[@name="' . $frbrElementType . '"]/xs:sequence/xs:element');
  $docId = $frbrElementName;

  //check to see if this node has been deleted
  if (count($rdaSelected) && !isset($rdaSelected[$frbrElementName]['include'])): //frbrElement node does not exist in POST
    //note: http://www.kavoir.com/2008/12/how-to-delete-remove-nodes-in-simplexml.html
    //delete the node
    deleteNode($frbrElement);
    deleteNode($rdaType[0]);

  else: //frbrElement node exists in POST

  $frbrElement['minOccurs'] = (isset($rdaSelected[$frbrElementName]['min']) && "Mandatory" == $rdaSelected[$frbrElementName]['min']) ? "1" : "0";

  $frbrMinOccurs   = (integer)$frbrElement['minOccurs'];
  $frbrMaxOccurs   = (integer)$frbrElement['maxOccurs'];

  $minChecked = (1 == $frbrMinOccurs) ? ' checked="checked"' : '';
  $optChecked = (1 != $frbrMinOccurs) ? ' checked="checked"' : '';

 //display include checkbox -- the element name -- the mandatory (minOccurs > 1) checkbox
  if ($displayOn):
?>
  <li>
    <input type="checkbox" name="<?php echo $frbrElementName ?>[include]" value="true" checked="checked" />
    <label class="tree"><?php echo $frbrElementDoc ?></label>
    <div class="mandatory">
        <input type="radio" name="<?php echo $frbrElementName ?>[min]" id="<?php echo $frbrElementName . "_rad_1" ?>" value="Mandatory" <?php echo $minChecked ?> />
        <label for="<?php echo $frbrElementName . "_rad_1" ?>" >Mandatory</label>
        &nbsp;&nbsp;<input type="radio" name="<?php echo $frbrElementName ?>[min]" id="<?php echo $frbrElementName . "_rad_2" ?>" value="Optional" <?php echo $optChecked ?> />
        <label for="<?php echo $frbrElementName . "_rad_2" ?>" >Optional</label>
    </div>
    <div class="frbrDoc" id="<?php echo $docId ?>">
      <?php echo $rdaElementsDoc ?>
    </div>
    <ul>
<?php
  endif; //DisplayOn
 //for each element
  foreach ($rdaElements as $rdaElement):
    //get the element name attribute
    $rdaElementName = (string)$rdaElement['name'];

    $rdaElementDoc = getDoc($rdaElement, 'xs:annotation/xs:documentation');

    //get the sub elements
    $rdaSubElements = $rdaElement->xpath('xs:complexType/xs:sequence/xs:element');

    $liName = $frbrElementName . "[" . $rdaElementName . "]";

    $docId = $frbrElementName . $rdaElementName;

    //check to see if this node has been deleted
    if (count($rdaSelected) && !isset($rdaSelected[$frbrElementName][$rdaElementName]['include'])): //rdaElement node does not exist in POST
      //delete the node
      deleteNode($rdaElement);
    else: //rdaElement node exists in POST
      $rdaElement['minOccurs'] = (isset($rdaSelected[$frbrElementName][$rdaElementName]['min']) && "Mandatory" == $rdaSelected[$frbrElementName][$rdaElementName]['min']) ? "1" : "0";

      $rdaMinOccurs   = (integer)$rdaElement['minOccurs'];
      $rdaMaxOccurs   = (integer)$rdaElement['maxOccurs'];

      $minChecked = (1 == $rdaMinOccurs) ? ' checked="checked"' : '';
      $optChecked = (1 != $rdaMinOccurs) ? ' checked="checked"' : '';

    //display include checkbox -- the element name -- the mandatory (minOccurs > 1) checkbox
    //get/display the element documentation
  if ($displayOn):?>
    <li>
      <input type="checkbox" name="<?php echo $liName ?>[include]" value="true" checked="checked" />
      <label class="tree"><?php echo $rdaElementName ?></label>
<!--      <a class="load-local" href="#<?php echo $docId ?>" rel="#<?php echo $docId ?>"><img src="images/note2.gif" alt="" height="10" width="8" /></a> -->
      <div class="mandatory">
          <input type="radio" name="<?php echo $liName ?>[min]" id="<?php echo $liName . "_rad_1" ?>" value="Mandatory" <?php echo $minChecked ?> />
          <label for="<?php echo $liName . "_rad_1" ?>" >Mandatory</label>
          &nbsp;&nbsp;<input type="radio" name="<?php echo $liName ?>[min]" id="<?php echo $liName . "_rad_2" ?>" value="Optional" <?php echo $optChecked ?> />
          <label for="<?php echo $liName . "_rad_2" ?>" >Optional</label>
      </div>
      <div class="frbrDoc" id="<?php echo $docId ?>">
        <?php echo $rdaElementDoc ?>
        <?php echo getVocabulary($rdaElement)  //get the vocabulary ?>
      </div>
<?php
  endif; //DisplayOn
if ($rdaSubElements):
  if ($displayOn):
?>
      <ul>
<?php
  endif; //DisplayOn
      //for each sub element
      $rdaParentName = $rdaElementName;
      foreach ($rdaSubElements as $rdaSubElement):
        //get the element name attribute
        $rdaSubElementName = (string)$rdaSubElement['name'];
        $rdaSubMinOccurs   = (integer)$rdaSubElement['minOccurs'];

        $minSubChecked = (1 == $rdaSubMinOccurs) ? ' checked="checked"' : '';
        $optSubChecked = (1 != $rdaSubMinOccurs) ? ' checked="checked"' : '';

        $liName = $frbrElementName . "[" . $rdaElementName . "][" . $rdaSubElementName . "]";
        $docId = $frbrElementName . $rdaElementName . $rdaSubElementName;

        $rdaSubElementDoc = getDoc($rdaSubElement, 'xs:annotation/xs:documentation');

        //check to see if this node has been deleted
        if (count($rdaSelected) && !isset($rdaSelected[$frbrElementName][$rdaElementName][$rdaSubElementName]['include'])): //rdaSubElement node does not exist in POST
          //delete the node
          deleteNode($rdaSubElement);
        else: //rdaSubElement node exists in POST
          $rdaSubElement['minOccurs'] = (isset($rdaSelected[$frbrElementName][$rdaElementName][$rdaSubElementName]['min']) && "Mandatory" == $rdaSelected[$frbrElementName][$rdaElementName][$rdaSubElementName]['min']) ? "1" : "0";

          $rdaSubMinOccurs   = (integer)$rdaSubElement['minOccurs'];
          $rdaSubMaxOccurs   = (integer)$rdaSubElement['maxOccurs'];

          $minSubChecked = (1 == $rdaSubMinOccurs) ? ' checked="checked"' : '';
          $optSubChecked = (1 != $rdaSubMinOccurs) ? ' checked="checked"' : '';

        //display include checkbox -- the element name -- the mandatory (minOccurs > 1) checkbox
        //get/display the element documentation
  if ($displayOn):
?>
      <li>
        <input type="checkbox" name="<?php echo $liName ?>[include]" value="true" checked="checked" />
        <label class="tree"><?php echo $rdaSubElementName ?></label>
        <div class="mandatory">
            <input type="radio" name="<?php echo $liName ?>[min]" id="<?php echo $liName . "_rad_1" ?>" value="Mandatory" <?php echo $minSubChecked ?> />
            <label for="<?php echo $liName . "_rad_1" ?>" >Mandatory</label>
            &nbsp;&nbsp;<input type="radio" name="<?php echo $liName ?>[min]" id="<?php echo $liName . "_rad_2" ?>" value="Optional" <?php echo $optSubChecked ?> />
            <label for="<?php echo $liName . "_rad_2" ?>" >Optional</label>
        </div>
        <div class="frbrDoc" id="<?php echo $docId ?>">
          <?php echo $rdaSubElementDoc ?>
          <?php echo getVocabulary($rdaSubElement)  //get the vocabulary ?>
        </div>
      </li>
<?php
  endif; //DisplayOn
endif; //rdaSubElement node exists in POST?>
<?php endforeach; //end for each sub element
  if ($displayOn):
?>
      </ul>
<?php
  endif; //DisplayOn
endif; //$rdaSubElements
  if ($displayOn):
?>
    </li>
<?php
  endif; //DisplayOn
endif; //rdaElement node exists in POST?>
<?php endforeach; //end for each element
  if ($displayOn):
?>
  </ul>
  </li>
<?php
  endif; //DisplayOn
endif; //frbrElement node exists in POST?>
<?php endforeach; //end for each of the frbr elements
  if ($displayOn):
?>
</ul>
</div>
<input type="hidden" name="processedUrl" value="<?php echo $Url ?>" />
<input type="submit" name="procSubmit" id="procSubmit" value="Preview My Schema" />
<input type="submit" name="fileSubmit" id="fileSubmit" value="Download My Schema" />
</form>
<?php
  endif; //DisplayOn
endif; //CAN load the schema
$doc = new DOMDocument('1.0');
$doc->preserveWhiteSpace = false;
$doc->loadXML($rda->asXML());
$doc->formatOutput = true;

  if ($displayOn):
?>
<pre >
<?php
if (isset($_POST['procSubmit']))
{
  echo htmlentities($doc->saveXML());
}
  ?>
</pre>
</body>
</html>
<?php else:
//force download the file
  $xmlFile = $doc->saveXML();
  $size = strlen($xmlFile);
  $mime = 'application/xml';
  header('Pragma: public');   // required
  header('Expires: 0');    // no cache
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Last-Modified: '.gmdate ('D, d M Y H:i:s', time()) .' GMT');
  header('Cache-Control: private',false);
  header('Content-Type: '.$mime);
  header('Content-Disposition: attachment; filename="'.basename($Url).'"');
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: '.$size);  // provide file size
  header('Connection: close');
  // send the file content
  echo $xmlFile;
endif; //DisplayOn
?>
