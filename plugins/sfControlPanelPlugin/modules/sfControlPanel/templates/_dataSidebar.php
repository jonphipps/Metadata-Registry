  <?php if(isset($model_files)): ?>
  <ul>
    <?php foreach ($model_files as $model): ?>
    <?php $model = substr($model, 0, strlen($model)-8) ?>
    <li class="data"><?php echo link_to($model, 'sfControlPanel/tableManager?class='.$model) ?></li>
    <?php endforeach; ?>
  </ul>
  <?php else: ?>
    No model files found
  <?php endif; ?>
