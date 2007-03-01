<?php use_helper('Javascript', 'ControlPanel') ?>
<?php $counter = 0 ?>

<?php slot('sidebar') ?>
<ul>
<?php foreach($lines as $line): ?>
  <?php if(isset($line['close'])): ?>
    <?php foreach($line['close'] as $dir): ?>
      </ul>
    <?php endforeach; ?>
  <?php endif; ?>
  <?php if(isset($line['open'])): ?>
    <?php foreach($line['open'] as $dir): $counter++ ?>
      <li class="folder">
        <?php echo link_to_function($dir, visual_effect('toggle_blind', $dir.$counter, array('duration' => 0.5))) ?>
      </li>
      <ul style="display:none;" id="<?php echo $dir.$counter ?>">
    <?php endforeach; ?>
  <?php endif; ?>
  <li class="file">
    <?php echo link_to_remote_pane_file($line['filename'], $line['path']) ?>
  </li>
<?php endforeach; ?>
</ul>
<?php end_slot() ?>

<div id="feedback">
  <?php if(isset($file)): ?>
  <h1>SF_ROOT_DIR/<?php echo $filename ?></h1>
  <?php echo $file ?>
  <?php endif; ?>
</div>