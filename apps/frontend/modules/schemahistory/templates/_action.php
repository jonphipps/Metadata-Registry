<?php

  //FIXME this is almost the same code that is used in concept history, so this should be refactored
  //<a class="load-local" href="#update_$id" rel="#update_$id">updated...</a>

  $action = $schema_property_element_history->getAction();
  if ('updated' == $action)
  {
    $object   = $schema_property_element_history->getObject();
    $language = $schema_property_element_history->getLanguage();
    $status   = $schema_property_element_history->getStatus();
    $id = $schema_property_element_history->getId();

    /** @var ConceptPropertyHistory **/
    $previous = $schema_property_element_history->getPrevious();
    if ($previous)
    {
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
  }
  else
  {
    echo $action;
  }
