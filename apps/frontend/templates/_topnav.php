<?php echo stylesheet_tag('tabs') ?>
<?php
  $topnav = array();
  $topnav['Owners']['link'] = 'agent/list';
  $topnav['Owners']['subnav']['Individuals']  = 'agent/list';
  $topnav['Owners']['subnav']['Organization'] = 'agent/list';
  $topnav['Resources']['link'] = 'vocabulary/list';
  $topnav['Resources']['subnav']['Vocabularies'] = 'vocabulary/list';
  $topnav['Resources']['subnav']['Schemas'] = '#';
  $topnav['Resources']['subnav']['Application Profiles'] = '#';
  $topnav['Resources']['subnav']['Crosswalks'] = '#';
?>
<ul id="topnav" class="double">
<?php $i = 0;
  foreach ($topnav as $key => $value):
    $here = false;
    $module = $sf_params->get('module');
    $action = $sf_params->get('action');
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

?>
  <li><?php echo link_to(__($key), $value['link'], $options) ?>
<?php if ($here): ?>
    <ul id="subnav">
<?php foreach ($value['subnav'] as $subLabel => $subLink): ?>
<?php if ($module . '/' . $action == $subLink): ?>
      <li><?php echo link_to(__($subLabel), "#", array('class' => 'here')) ?></li>
<?php else: ?>
      <li><?php echo link_to(__($subLabel), $subLink) ?></li>
<?php endif; ?>
<?php endforeach; ?>
    </ul>
<?php endif; ?>
</li>
<?php endforeach; ?>
</ul>
