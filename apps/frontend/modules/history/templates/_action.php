<?php

  // use the following instead of 'updated...' when we get the jscript working...
  //<a class="load-local" href="#update_$id" rel="#update_$id">updated...</a>

  $action = $concept_property_history->getAction();
  if ('updated' == $action)
  {
    $object   = $concept_property_history->getObject();
    $language = $concept_property_history->getLanguage();
    $status   = $concept_property_history->getStatus();
    $id = $concept_property_history->getId();

    /** @var ConceptPropertyHistory **/
    $previous = $concept_property_history->getPrevious();
    $oldAction = $previous->getAction();
    $oldObject = $previous->getObject();
    $oldStatus = $previous->getStatus();
    $oldLanguage = $previous->getLanguage();
    $str = <<<EOD
<a class="load-local" href="#detail_$id" rel="#detail_$id" title="Change Detail">updated...</a>
<div id="detail_$id">
  <table cellpadding="0" cellspacing="0" class="rowDetail">
    <tr>
      <th>&nbsp;</th>
      <td colspan="2">Previous Action: "$oldAction"</td>
    </tr>
    <tr class="rowDetailNew">
      <th rowspan="2">Object: </th>
      <td>New</td>
      <td>$object</td>
    </tr>
    <tr class="rowDetailOld">
      <td>Old</td>
      <td>$oldObject</td>
    </tr>
    <tr class="rowDetailNew">
      <th rowspan="2">Language: </th>
      <td>New</td>
      <td>$language</td>
    </tr>
    <tr class="rowDetailOld">
      <td>Old</td>
      <td>$oldLanguage</td>
    </tr>
    <tr class="rowDetailNew">
      <th rowspan="2">Status: </th>
      <td>New</td>
      <td>$status</td>
    </tr>
    <tr class="rowDetailOld">
      <td>Old</td>
      <td>$oldStatus</td>
    </tr>
  </table>
</div>
EOD;
    echo $str;
  }
  else
  {
    echo $action;
  }
