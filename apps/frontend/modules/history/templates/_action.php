<?php
  //debugbreak();
  // use the following instead of 'updated...' when we get the jscript working...
  //<a class="load-local" href="#update_$id" rel="#update_$id">updated...</a>

  $action = $concept_property_history->getAction();
  if ('updated' == $action)
  {
    $object   = $concept_property_history->getObject();
    $language = $concept_property_history->getLanguage();
    $status   = $concept_property_history->getStatus();
    $id = $concept_property_history->getId();
    $str = <<<EOD
updated...
<div id="update_$id">
  <table>
    <tr>
      <td>Object: </td>
      <td>$object</td>
    </tr>
    <tr>
      <td>Language: </td>
      <td>$language</td>
    </tr>
    <tr>
      <td>Status: </td>
      <td>$status</td>
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
