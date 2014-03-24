<?php
  $sf_context->getResponse()->addStylesheet('ui');
  $topnav = array();
  $topnav['Detail']['link']  = '/conceptprop/show?id=';
  $topnav['History']['link'] = '/history/list?property_id=';;
  $topnav['Versions']['link'] = '#';;
?>
<div id="tab_container">
<ul class="ui-tabs-nav" >
<?php
  $i = 0;
  $module = $sf_params->get('module');
  $action = $sf_params->get('action');

  foreach ($topnav as $key => $value):
    $here = false;
    $options = array();
    $options['id'] = 'a' . $i;
    $i++;

    if (false !== strpos($value['link'], $module . '/' . $action))
    {
      echo '<li class = "ui-tabs-selected">' . link_to('<span>' . __($key) . '</span>', $value['link'] . $concept_property->getID(), $options) . '</li>';
    }
    else
    {
      echo '<li>' . link_to('<span>' . __($key) . '</span>', $value['link'] . $concept_property->getID(), $options) . '</li>';
    }
  endforeach;
?>
</ul>
</div>
