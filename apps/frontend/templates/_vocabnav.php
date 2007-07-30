<?php
  $topnav = array();
  $topnav['Detail']['link']  = '/vocabulary/show?id=';
  $topnav['Concepts']['link'] = '/concept/list?vocabulary_id=';
  $topnav['History']['link'] = '/history/list?vocabulary_id=';
  $topnav['Versions']['link'] = '#';;
  $topnav['Users']['link'] = 'vocabuser/list?vocabulary_id=';
?>
<ul id="topnav" style="height:1.85em; position:relative;" class="single" >
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
