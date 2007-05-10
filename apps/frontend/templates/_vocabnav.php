<?php echo stylesheet_tag('tabs') ?>
<?php
  $topnav = array();
  $topnav['Detail']['link']  = '/vocabulary/show?id=';
  $topnav['Concepts']['link'] = '/concept/list?vocabulary_id=';
  $topnav['History']['link'] = '#';;
  $topnav['Versions']['link'] = '#';;
?>
<ul id="topnav" style="height:1.9em; position:relative">
<?php $i = 0;
  foreach ($topnav as $key => $value):
    $here = false;
    $module = $sf_params->get('module');
    $action = $sf_params->get('action');
    $options = array();
    $options['id'] = 'a' . $i;
    $i++;

    if (false !== strpoS($value['link'], $module . '/' . $action))
    {
      $options['class'] = 'here';
    }
?>
  <li><?php echo link_to(__($key), $value['link'] . $vocabulary->getID(), $options) ?></li>
<?php endforeach; ?>
</ul>
