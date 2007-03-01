<?php use_helper('ControlPanel', 'Javascript') ?>

<?php slot('sidebar') ?>
<ul>

  <li class="category"><?php echo link_to_toggle('Model', 'model_links') ?></li>
  <ul id="model_links" style="display:none;">
  <?php if (isset($schema_files)): ?>
  <li class="category"><?php echo link_to_toggle('Relational Model', 'relational_model_links') ?></li>
  <ul id="relational_model_links">
    <?php foreach ($schema_files as $schema_file): ?>
    <li class="file"><?php echo link_to_remote_pane_file($schema_file) ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>

  <?php if (isset($model_files)): ?>
  <li class="category"><?php echo link_to_toggle('Object Model', 'object_model_links') ?></li>
  <ul id="object_model_links">
    <?php foreach ($model_files as $model): ?>
    <?php $model = substr($model, 0, strlen($model)-8) ?>
    <li class="file category"><?php echo link_to_toggle($model.'.php', $model.'_methods') ?></li>
    <?php if(isset($model_methods[$model]['object'])): ?>
    <ul id="<?php echo $model ?>_methods" style="display:none">
      <?php foreach($model_methods[$model]['object'] as $model_name => $value): ?>
      <li class="file_model <?php echo $value[1] ?>"><?php echo link_to_remote_pane_file($model_name, $value[0].'#function_'.$model_name) ?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <li class="file category"><?php echo link_to_toggle($model.'Peer.php', $model.'_peer_methods') ?></li>
    <?php if(isset($model_methods[$model]['peer'])): ?>
    <ul id="<?php echo $model ?>_peer_methods" style="display:none">
      <?php foreach($model_methods[$model]['peer'] as $model_name => $value): ?>
      <li class="file_model <?php echo $value[1] ?>"><?php echo link_to_remote_pane_file($model_name, $value[0].'#function_'.$model_name) ?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>

  <?php if (isset($connection_files)): ?>
  <li class="category"><?php echo link_to_toggle('Connection Settings', 'connection_model_links') ?></li>
  <ul id="connection_model_links">
    <?php foreach ($connection_files as $connection_file): ?>
    <li class="file"><?php echo link_to_remote_pane_file($connection_file) ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>  
  </ul>

  <li class="category"><?php echo link_to_toggle('View', 'view_links') ?></li>
  <ul id="view_links" style="display:none">
    <?php if(isset($apps)): ?>
    <?php foreach ($apps as $app) : ?>
    <li class="category"><?php echo link_to_toggle($app, 'app_'.$app.'_view') ?></li>
    <ul id="app_<?php echo $app ?>_view">
      <?php foreach ($modules[$app] as $module): ?>
      <?php if(isset($module_templates[$app][$module])): ?>
      <li class="category"><?php echo link_to_toggle($module, 'app_'.$app.$module.'_view') ?></li>
      <ul id="app_<?php echo $app.$module ?>_view" style="display:none">          
        <?php foreach ($module_templates[$app][$module] as $template): ?>
        <li class="file_template"><?php echo link_to_remote_pane_file($template, 'apps/'.$app.'/modules/'.$module.'/templates/'.$template) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php else: ?>
      <li class="category empty"><?php echo $module ?></li>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php if (isset($app_templates[$app])): ?>
      <li class="category"><?php echo link_to_toggle('global', 'app_'.$app.'_global_view') ?></li>
      <ul id="app_<?php echo $app ?>_global_view" style="display:none">
        <?php foreach ($app_templates[$app] as $template): ?>
        <li class="file_template"><?php echo link_to_remote_pane_file($template, 'apps/'.$app.'/templates/'.$template) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </ul>
    <?php endforeach; ?>
    <?php endif; ?>
  </ul>

  <li class="category"><?php echo link_to_toggle('Controller', 'controller_links') ?></li>
  <ul id="controller_links" style="display:none">
    <?php if(isset($apps)): ?>
    <?php foreach ($apps as $app) : ?>
    <li class="category"><?php echo link_to_toggle($app, 'app_'.$app.'_controller') ?></li>
    <ul id="app_<?php echo $app ?>_controller">
      <?php foreach ($modules[$app] as $module): ?>
      <?php if(isset($module_actions[$app][$module])): ?>
      <li class="category"><?php echo link_to_toggle($module, 'app_'.$app.$module.'_controller') ?></li>
      <ul id="app_<?php echo $app.$module ?>_controller" style="display:none">          
        <?php foreach ($module_actions[$app][$module] as $action_name => $action_file): ?>
        <li class="file_action"><?php echo link_to_remote_pane_file(strtolower($action_name), 'apps/'.$app.'/modules/'.$module.'/actions/'.$action_file.'#function_execute'.$action_name) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php else: ?>
      <li class="category empty"><?php echo $module ?></li>
      <?php endif; ?>
      <?php endforeach; ?>
    </ul>
    <?php endforeach; ?>
    <?php endif; ?>
  </ul>
 
 
</ul>
<?php end_slot() ?>

<div id="feedback">

<div id="apps_envs" class="summary">
  <h1>Applications and environments</h1>
  <?php foreach ($apps as $app) : ?>
  <ul>
    <li class="application"><?php echo $app ?></li>
    <ul>  
      <?php foreach ($environments[$app] as $name => $controller): ?>
      <li><a href="<?php echo _compute_public_path($controller, '.', '') ?>">Browse in <?php echo $name ?></a></li>
      <?php endforeach; ?>
    </ul>
  </ul>
  <?php endforeach; ?>
</div>

<div id="sf_libraries" class="summary">
  <h1>Symfony files</h1>
  <ul>
  <li>Version: <?php echo $sf_version ?></li>
  <li>Path to libraries</li>
  <ul>
    <li><?php echo sfConfig::get('sf_symfony_lib_dir') ?></li>
    <li><?php echo sfConfig::get('sf_symfony_data_dir') ?></li>
  </ul>
  <?php if (isset($plugins)): ?>
  <li>Installed Plug-ins</li>
  <ul>
    <?php foreach ($plugins as $plugin): ?>
    <li><?php echo $plugin ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</div>

</div>
