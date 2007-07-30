<?php
  $topnav = array();
  $topnav['Detail']['link']  = '/concept/show?id=';
  $topnav['Properties']['link'] = '/conceptprop/list?concept_id=';
  $topnav['History']['link'] = '/history/list?concept_id=';;
  $topnav['Versions']['link'] = '#';;
?>
<ul id="topnav" style="height:1.85em; position:relative;" class="single" >
<?php
  //debugbreak();
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
      $options['class'] = 'here';
    }

    echo '<li>' . link_to(__($key), $value['link'] . $concept->getID(), $options) . '</li>';

  endforeach;
?>
</ul>
