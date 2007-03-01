<?php use_helper('ControlPanel', 'Javascript') ?>

<?php slot('sidebar') ?>
<ul class="flat">
  <ul>
    <li class="task unfortunate"><?php echo link_to_remote_pane('task list', 'sfControlPanel/taskExecute') ?></li>
    <li class="task unfortunate"><?php echo link_to_function('execute task...', visual_effect('toggle_blind', 'execute_custom_task')) ?></li>
  </ul>

  <li class="category">Cache</li>
  <ul>
    <li class="task"><?php echo link_to_remote_pane('clear cache', 'sfControlPanel/taskExecute?task=clear-cache') ?></li>
    <li class="task"><?php echo link_to_function('clear selectively...', visual_effect('toggle_blind', 'clear_selective_cache')) ?></li>
  </ul>

  <li class="category">Model</li>
  <ul>
    <li class="task"><?php echo link_to_remote_pane('build model', 'sfControlPanel/taskExecute?task=propel-build-model') ?></li>
    <li class="task"><?php echo link_to_remote_pane('build sql', 'sfControlPanel/taskExecute?task=propel-build-sql') ?></li>
    <li class="task"><?php echo link_to_remote_pane('insert sql', 'sfControlPanel/taskExecute?task=propel-insert-sql') ?></li>
    <li class="task"><?php echo link_to_remote_pane('build all', 'sfControlPanel/taskExecute?task=propel-build-all') ?></li>
  </ul>

  <li class="category">Module</li>
  <ul>
    <li class="task"><?php echo link_to_function('add new module...', visual_effect('toggle_blind', 'add_new_module')) ?></li>
  </ul>

  <li class="category">Project</li>
  <ul>
    <li class="task"><?php echo link_to_remote_pane('freeze', 'sfControlPanel/taskExecute?task=freeze') ?></li>
    <li class="task"><?php echo link_to_remote_pane('unfreeze', 'sfControlPanel/taskExecute?task=unfreeze') ?></li>
    <li class="task"><?php echo link_to_remote_pane('sync', 'sfControlPanel/taskExecute?task=sync') ?></li>
    <li class="task"><?php echo link_to_remote_pane('fix-perms', 'sfControlPanel/taskExecute?task=fix-perms') ?></li>
  </ul>

  <li class="category">Log files</li>
  <ul>
    <li class="task"><?php echo link_to_remote_pane('purge logs', 'sfControlPanel/taskExecute?task=log-purge') ?></li>
    <li class="task"><?php echo link_to_remote_pane('rotate logs', 'sfControlPanel/taskExecute?task=log-rotate') ?></li>
  </ul>

  <li class="category">Plugin</li>
  <ul>
    <li class="task"><?php echo link_to_remote_pane('plugin list', 'sfControlPanel/taskExecute?task=plugin-list') ?></li>
  </ul>

  <?php if (isset($batches)): ?>
  <li class="category">Batch</li>
  <ul>
    <?php foreach ($batches as $batch): ?>
    <li class="task"><?php echo link_to_remote_pane($batch, 'sfControlPanel/taskExecute?batch='.$batch) ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
<!-- 
  <li class="category">Application</li>
  <ul>
    <li class="task"><?php echo link_to_function('enable/disable...', visual_effect('blind_down', 'enabe_disable')) ?></li>
  </ul>

    <li class="task">Install Plug-ins...</li>
    <li class="task">Launch tests...</li> 
-->
</ul>
<?php end_slot() ?>

<div id="execute_custom_task" class="task_detail" style="display:none;">
  <?php echo form_remote_tag(array(
    'url'    => 'sfControlPanel/taskExecute',
    'update' => 'feedback',
    'loading' => "Element.addClassName(document.getElementsByTagName('html')[0], 'waiting');",
    'success' => "Element.removeClassName(document.getElementsByTagName('html')[0], 'waiting');".visual_effect('blind_up', 'execute_custom_task'),
  )) ?>
    Execute free task: symfony
    <?php echo input_tag('freetask') ?>
    <?php echo submit_tag('execute') ?>
    <?php echo button_to_function('cancel', visual_effect('blind_up', 'execute_custom_task')) ?>
  </form>
</div>

<div id="clear_selective_cache" class="task_detail" style="display:none;">

  <?php echo form_remote_tag(array(
    'url'    => 'sfControlPanel/taskExecute',
    'update' => 'feedback',
    'loading' => "Element.addClassName(document.getElementsByTagName('html')[0], 'waiting');",
    'success' => "Element.removeClassName(document.getElementsByTagName('html')[0], 'waiting');".visual_effect('blind_up', 'clear_selective_cache'),
  )) ?>
    <?php echo input_hidden_tag('task', 'clear-cache') ?>
    Clear
    <select name="arg[1]">
      <option value="">all cache</option>
      <option value="config">only configuration cache</option>
      <option value="template">only template cache</option>
    </select>
    for application
    <select name="arg[0]">
      <?php foreach($apps as $app): ?>
      <option><?php echo $app ?></option>
      <?php endforeach; ?>
    </select>
    <?php echo submit_tag('execute') ?>
    <?php echo button_to_function('cancel', visual_effect('blind_up', 'clear_selective_cache')) ?>
  </form>
  
</div>

<div id="add_new_module" style="display: none;">
  <?php echo form_remote_tag(array(
    'url'    => 'sfControlPanel/taskExecute',
    'update' => 'feedback',
    'loading' => "Element.addClassName(document.getElementsByTagName('html')[0], 'waiting');",
    'success' => "Element.removeClassName(document.getElementsByTagName('html')[0], 'waiting');".visual_effect('blind_up', 'clear_selective_cache'),
  )) ?>
    create new module
    
    of type
    <select name="task" onChange="if (String(this.value).indexOf('propel') == 0) divdisplay ='block'; else divdisplay ='none'; $('propel_module_models').style.display = divdisplay;">
      <option value="init-module">empty skeleton</option>
      <?php if ($model_files): ?>
      <option value="propel-init-crud">scaffolding (init)</option>
      <option value="propel-generate-crud">scaffolding (generate)</option>
      <option value="propel-init-admin">administration</option>
      <?php endif; ?>
    </select>

    for application
    <select name="arg[0]">
      <?php foreach($apps as $app): ?>
      <option><?php echo $app ?></option>
      <?php endforeach; ?>
    </select>
        
    named
    <input type="text" name="arg[1]">

    <?php if ($model_files): ?>
    <span id="propel_module_models" style="display:none">
    based on  
    <select name="arg[2]" id="propel_module_models_select">
      <?php foreach ($model_files as $model_file): ?>
      <?php $model = substr($model_file, 0, strlen($model_file)-8) ?>
      <option value="<?php echo $model ?>"><?php echo $model ?></option>
      <?php endforeach; ?>
    </select>
    </span>
    <?php endif; ?>

    <input type="submit" value="execute">
    
  </form>
</div>

<div id="tests" style="display:none;">
  
      <li><a class="task" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>?task=test&arg[0]=<?php echo $app ?>">Launch test suite</a></li>

</div>

<div id="feedback"></div>