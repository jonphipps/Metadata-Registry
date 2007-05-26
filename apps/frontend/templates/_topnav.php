<?php echo stylesheet_tag('tabs') ?>
<?php
  $topnav = array();
  $topnav['Owners']   ['link']                           = 'agent/list';
  $topnav['Owners']   ['subnav']['Individuals']          = 'agent/list';
  $topnav['Owners']   ['subnav']['Organization']         = 'agent/list';
  $topnav['Resources']['link']                           = 'vocabulary/list';
  $topnav['Resources']['subnav']['Vocabularies']         = 'vocabulary/list';
  $topnav['Resources']['subnav']['Schemas']              = '#';
  $topnav['Resources']['subnav']['Application Profiles'] = '#';
  $topnav['Resources']['subnav']['Crosswalks']           = '#';
?>
<ul id="topnav" class="double">
<?php
  $i = 0;
  $module = $sf_params->get('module');
  $action = $sf_params->get('action');

  foreach ($topnav as $key => $value)
  {
    $here = false;
    $options = array();
    $options['id'] = 'a' . $i;
    $i++;

    foreach ($value['subnav'] as $subLabel => $subLink)
    {
      if ($module . '/' . $action == $subLink)
      {
        $options['class'] = 'here';
        $here = true;
      }
    }

    echo "<li>" . link_to(__($key), $value['link'], $options);

    //this writes the 2nd level submenu
    if ($here)
    {
      echo '<ul id="subnav">';
      foreach ($value['subnav'] as $subLabel => $subLink)
      {
        if ($module . '/' . $action == $subLink)
        {
          echo "<li>" . link_to(__($subLabel), "#", array('class' => 'here')) . "</li>";
        }
        else
        {
          echo "<li>" . link_to(__($subLabel), $subLink) . "</li>";
        }
      }
      echo "</ul>";
    }
    echo "</li>";
  }
?>
</ul>
