<?php use_helper('I18N'); ?>
<?php use_helper('JavascriptBase'); ?>
<h2 class="sf_comments_title"><?php echo __('Comments') ?></h2>
<div id="sf_comment_list">
  <?php if (count($comments) > 0): ?>
    <?php foreach ($comments as $comment): ?>
      <?php include_partial('sfComment/commentView', array('comment' => $comment)) ?>
    <?php endforeach; ?>
  <?php else: ?>
    <p>
      <?php echo __('There is no comment for the moment.') ?>
    </p>
  <?php endif; ?>
</div>