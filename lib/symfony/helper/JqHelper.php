<?php
/**
 * Javascript helper for jqwidgets
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-10-03
 * Time: 5:26 PM
 */

function jqListFromSelect($name, $values, $url, $tag_options = [])
{

  $context = sfContext::getInstance();

  $tag_options = _convert_options($tag_options);

  $response = $context->getResponse();
  $jqwidgetsDir = sfConfig::get('sf_jqwidgets_web_dir') ;
  $response->addJavascript(sfConfig::get('sf_jqwuery_web_dir') . '/jquery.min.js');
  $response->addJavascript($jqwidgetsDir . '/jqxcore.js');
  $response->addJavascript($jqwidgetsDir . '/jqxscrollbar.js');
  $response->addJavascript($jqwidgetsDir . '/jqxbuttons.js');
  $response->addJavascript($jqwidgetsDir . '/jqxlistbox.js');
  $response->addJavascript($jqwidgetsDir . '/jqxcore.js');

}
