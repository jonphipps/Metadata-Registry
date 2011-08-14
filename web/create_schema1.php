<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Create a Custom RDA Schema</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="Text/css">
  p, body, td, th, .txt {font-family: helvetica,arial,sans-serif; font-size: 90%; color: #003366;}
  .cpr {font-family: helvetica,arial,sans-serif; font-size: 60%; color: #000000;}
  .comp {font-family: helvetica,arial,sans-serif; font-size: 80%; color: #000000;}
  h1 {font-family: helvetica,arial,sans-serif; font-size: 150%; font-weight: 600; color: #003366;}
  h2 {font-family: helvetica,arial,sans-serif; color: #003366;}
  h3 {font-family: helvetica,arial,sans-serif; color: #003366;}
  p.mandatory { margin-top: 0px}
  div.form { border: medium solid; width: 600px; height: 500px; overflow: scroll; padding: 10px;}
  div.mandatory { display: none;}
  p.frbrDoc, div.vocab { display: none;}
  </style>
  <link rel="stylesheet" type="text/css" href="css/checkboxtree.css" charset="utf-8">

  <script src="js/jq/jquery-latest.js" type="text/javascript"></script>
  <script src="js/jq/jquery.checkboxtree.js" type="text/javascript" language="JavaScript"></script>
  <script type="text/javascript">
jQuery(document).ready(function(){
  jQuery("#checkchildren").checkboxTree({
      collapsedarrow: "images/checkboxtree/img-arrow-collapsed.gif",
      expandedarrow: "images/checkboxtree/img-arrow-expanded.gif",
      blankarrow: "images/checkboxtree/img-arrow-blank.gif",
      checkchildren: true
  });
  jQuery("#dontcheckchildren").checkboxTree({
      collapsedarrow: "images/checkboxtree/img-arrow-collapsed.gif",
      expandedarrow: "images/checkboxtree/img-arrow-expanded.gif",
      blankarrow: "images/checkboxtree/img-arrow-blank.gif",
      checkchildren: false
  });
  jQuery("#docheckchildren").checkboxTree({
      collapsedarrow: "images/checkboxtree/img-arrow-collapsed.gif",
      expandedarrow: "images/checkboxtree/img-arrow-expanded.gif",
      blankarrow: "images/checkboxtree/img-arrow-blank.gif",
      checkchildren: true,
      checkparents: false
  });
  jQuery("#dontcheckchildrenparents").checkboxTree({
      collapsedarrow: "images/checkboxtree/img-arrow-collapsed.gif",
      expandedarrow: "images/checkboxtree/img-arrow-expanded.gif",
      blankarrow: "images/checkboxtree/img-arrow-blank.gif",
      checkchildren: false,
      checkparents: false
  });
});
</script>
</head>
<body>
<h1>Create a Custom RDA Schema</h1>
<form accept-charset="utf8" method="post" action="">
<div class="form">
<ul class="unorderedlisttree" id="checkchildren">
<?php

function getDoc($element, $xpath) {
  $doc = $element->xpath($xpath);
  return ($doc) ? (string)$doc[0] : '';
}

function getVocabulary($parentElement) {
  $vocElements = $parentElement->xpath('xs:complexType/xs:simpleContent/xs:extension/xs:attribute/xs:simpleType/xs:restriction/xs:enumeration');
  if ($vocElements)
  {
    //get/display xs:complexType[1]/xs:simpleContent[1]/xs:extension[1]/xs:attribute[1]->name
    $att = $parentElement->xpath('xs:complexType/xs:simpleContent/xs:extension/xs:attribute');
    $vocabName = (string)$att[0]['name'];
    $html = "\n<div class=" . '"vocab"' . ">\n<h2>$vocabName</h2>\n<dl>\n";

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

//note: http://www.kavoir.com/2008/12/how-to-delete-remove-nodes-in-simplexml.html

//load the schema
$rda = new SimpleXMLElement('rdaFull_7_7_09.xsd', null, true, 'xs', true);
$frbrElements = $rda->xpath('//xs:element[@name="RDARecord"]/xs:complexType/xs:sequence/xs:element');
$frbrDoc = getDoc($rda, '//xs:element[@name="RDARecord"]/xs:complexType/xs:annotation/xs:documentation');
//$frbrElements = $rda->xpath('/xs:schema/xs:element/xs:complexType/xs:sequence/descendant::xs:element');
//for each of the frbr elements
/** @var $element SimpleXMLElement **/
foreach ($frbrElements as $frbrElement):
  //get the attributes
  $frbrElementName = (string)$frbrElement['name'];
  $frbrMinOccurs   = (integer)$frbrElement['minOccurs'];
  $frbrMaxOccurs   = (integer)$frbrElement['maxOccurs'];
  $frbrElementType = (string)$frbrElement['type'];

  $minChecked = (1 == $frbrMinOccurs) ? ' checked="checked"' : '';

  //get/display the frbrelement documentation
  $frbrElementDoc = getDoc($frbrElement, 'xs:annotation/xs:documentation');

 //display include checkbox -- the element name -- the mandatory (minOccurs > 1) checkbox
?>
  <li>
    <input type="checkbox" name="<?php echo $frbrElementName ?>" value="Include" checked="checked" />
    <label class="tree"><?php echo $frbrElementDoc ?></label>
    <div class="mandatory">
      <div><input type="radio" name="<?php echo $frbrElementName ?>" id="<?php echo $frbrElementName . "_1" ?>" value="Mandatory"/> Mandatory</div>
      <div><input type="radio" name="<?php echo $frbrElementName ?>" id="<?php echo $frbrElementName . "_2" ?>" value="Optional"/> Optional</div>
    </div>
    <ul>
<?php
  //get the complextype documentation
  $rdaElementsDoc = getDoc($rda, '//xs:complexType[@name="' . $frbrElementType . '"]/xs:sequence/xs:annotation/xs:documentation');
  //load the complex type of the element
  $rdaElements = $rda->xpath('//xs:complexType[@name="' . $frbrElementType . '"]/xs:sequence/xs:element');
  //for each element
?>
<?php foreach ($rdaElements as $rdaElement):
    //get the element name attribute
    $rdaElementName = (string)$rdaElement['name'];
    $rdaMinOccurs   = (integer)$rdaElement['minOccurs'];
    $rdaMaxOccurs   = (integer)$rdaElement['maxOccurs'];

    $minChecked = (1 == $rdaMinOccurs) ? ' checked="checked"' : '';
    $rdaElementDoc = getDoc($rdaElement, 'xs:annotation/xs:documentation');

    //display include checkbox -- the element name -- the mandatory (minOccurs > 1) checkbox
    //get/display the element documentation
?>
    <li>
      <input type="checkbox" name="<?php echo $rdaElementName ?>" value="Include" checked="checked" />
      <label class="tree"><?php echo $rdaElementName ?></label>
      <div class="mandatory"><input type="checkbox" name="<?php echo $rdaElementName ?>" value="Mandatory" <?php echo $minChecked ?> />  Mandatory</div>
      <p class="frbrDoc"><?php echo $rdaElementDoc ?></p>
<?php
    //get the sub elements
    $rdaSubElements = $rdaElement->xpath('xs:complexType/xs:sequence/xs:element');
?>
<?php if ($rdaSubElements): ?>
      <ul>
<?php //for each sub element
      foreach ($rdaSubElements as $rdaSubElement):
        //get the element name attribute
        $rdaElementName = (string)$rdaSubElement['name'];
        $rdaMinOccurs   = (integer)$rdaSubElement['minOccurs'];

        $minChecked = (1 == $rdaMinOccurs) ? ' checked="checked"' : '';
        $rdaElementDoc = getDoc($rdaSubElement, 'xs:annotation/xs:documentation');
        //display include checkbox -- the element name -- the mandatory (minOccurs > 1) checkbox
        //get/display the element documentation
?>
      <li>
        <input type="checkbox" name="<?php echo $rdaElementName ?>" value="Include" checked="checked" />
        <label class="tree"><?php echo $rdaElementName ?></label>
        <div class="mandatory"><input type="checkbox" name="<?php echo $rdaElementName ?>" value="Mandatory" <?php echo $minChecked ?> />  Mandatory</div>
        <p class="frbrDoc"><?php echo $rdaElementDoc ?></p>
        <?php echo getVocabulary($rdaSubElement)  //get the vocabulary ?>
      </li>
<?php endforeach; //end for each sub element ?>
      </ul>
<?php endif; //$rdaSubElements ?>
<?php echo getVocabulary($rdaElement)  //get the vocabulary ?>
    </li>
<?php endforeach; //end for each element ?>
  </ul>
  </li>
<?php endforeach; //end for each of the frbr elements ?>
</ul>
</div>
<input type="submit" name="cmdSubmit" id="cmdSubmit"
    value="Create My Schema"/>
</form>
</body>
</html>
