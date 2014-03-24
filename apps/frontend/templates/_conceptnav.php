<?php
  $sf_context->getResponse()->addStylesheet('ui');
  $topnav = array();
  $topnav['Detail']['link']  = '/concept/show?id=';
  $topnav['Properties']['link'] = '/conceptprop/list?concept_id=';
  $topnav['History']['link'] = '/history/list?concept_id=';;
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
      echo '<li class = "ui-tabs-selected">' . link_to('<span>' . __($key) . '</span>', $value['link'] . $concept->getID(), $options) . '</li>';
    }
    else
    {
      echo '<li>' . link_to('<span>' . __($key) . '</span>', $value['link'] . $concept->getID(), $options) . '</li>';
    }
  endforeach;
?>
</ul>
</div>
