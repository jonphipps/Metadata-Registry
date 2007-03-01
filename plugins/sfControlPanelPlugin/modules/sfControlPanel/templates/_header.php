<h1>"<?php echo $project_name ?>" project - symfony control panel</h1>
<div id="navigation">
  <ul>
    <li><?php echo link_to_unless($action == 'index', 'Overview', 'sfControlPanel/index') ?></li> 
    <li><?php echo link_to_unless($action == 'taskManager', 'Tasks', 'sfControlPanel/taskManager') ?></li>
    <li><?php echo link_to_unless($action == 'fileBrowser', 'Code', 'sfControlPanel/fileBrowser') ?></li>
    <li><?php echo link_to_unless($action == 'configShow', 'Configuration', 'sfControlPanel/configShow') ?></li>
    <li><?php echo link_to_unless($action == 'dataManager' || substr($module, 0, 4) == 'auto', 'Data', 'sfControlPanel/dataManager') ?></li>
  </ul>
</div>