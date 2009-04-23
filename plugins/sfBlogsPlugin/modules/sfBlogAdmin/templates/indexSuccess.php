<?php use_helper('I18N', 'Date') ?>
<?php if (count($logs)): ?>
  <ul class="timeline">
  <?php $day = 0 ?>
  <?php foreach ($logs as $log): ?>
    <?php if (date('dm', $log->getCreatedAt('U')) != $day): ?>
      <?php $day = date('dm', $log->getCreatedAt('U')) ?>
      <h3><?php echo format_date($log->getCreatedAt('U'), 'EEEE F MMMM') ?></h3>
    <?php endif ?>
    <li class="<?php echo $log->getVerb() ?>"><span class="time"><?php echo $log->getCreatedAt('H:i') ?></span><?php echo $log ?></li>
  <?php endforeach ?>
  </ul>
<?php else: ?>
  <div class="invite"><?php echo __('It looks like there is nothing in your blog history. If you just installed the blog application, you should now %link%.', array('%link%' => link_to(__('create a blog'), 'sfBlogAdmin/blogEdit'))) ?></div>
<?php endif ?>

