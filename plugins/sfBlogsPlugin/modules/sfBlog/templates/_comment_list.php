<?php use_helper('I18N') ?>
<?php foreach($comments as $comment): ?>
  <?php include_partial('sfBlog/comment', array('comment' => $comment)) ?>
<?php endforeach; ?>

<?php if(!$post->getsfBlog()->allowComments() || !$post->allowComments()): ?>
  <div class="related_details"><?php echo __('Comments are closed.') ?></div>
<?php elseif($sf_user->getFlash('add_comment') == 'moderated'): ?>
  <div class="comment moderated"><?php echo __('Your comment has been submitted and is awaiting moderation') ?></div>
<?php elseif($sf_user->getFlash('add_comment') != 'normal'): ?>
  <?php include_partial('sfBlog/add_comment', array('post' => $post)) ?>
<?php endif; ?>