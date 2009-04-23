<?php use_helper('Date', 'I18N') ?>
<div class="comment <?php if($comment->isPending()): ?>pending<?php endif; ?>" id="comment_<?php echo $comment->getId() ?>">

  <div class = "author">
    <?php echo image_tag('http://www.gravatar.com/avatar/'.md5($comment->getAuthorEmail()).'?s=36&d=http%3A%2F%2Fwww.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D36', 'style=float:left;padding-right:5px; size=36x36') ?>
    <div class="name"><?php echo $comment->getAuthorName() ?></div>
    <div class="from">
      <?php echo mail_to($comment->getAuthorEmail()) ?>
      <?php if ($comment->getAuthorUrl()): ?>
        - <a href="<?php echo $comment->getAuthorUrl() ?>"><?php echo $comment->getAuthorUrl() ?></a>
      <?php endif ?>&nbsp;
    </div>
  </div>

  <div class="content">
    <?php echo $comment->getContent() ?>
  </div>

  <div class="reference">
    <?php echo __('Posted on %date% about <b>%post%</b>', array(
      '%date%'  => format_date($comment->getCreatedAt('U')),
      '%post%'  => link_to($comment->getPostTitle(), 'sfBlogAdmin/postEdit?id='.$comment->getsfBlogPost()->getId())
      )) ?>
  </div>

  <ul class="comment_actions">
    <?php if (!$comment->isAccepted()): ?>
      <?php if ($comment->isSpam()): ?>
        <li><?php echo link_to(__('despam'), 'sfBlogAdmin/despamComment?id='.$comment->getId(), array('class' => 'decrease')) ?></li>
      <?php else: ?>
        <li><?php echo link_to(__('accept'), 'sfBlogAdmin/acceptComment?id='.$comment->getId()) ?></li>
        <li><?php echo link_to(__('spam'), 'sfBlogAdmin/spamComment?id='.$comment->getId(), array('class' => 'decrease')) ?></li>
      <?php endif; ?>
    <?php endif; ?>
    <li><?php echo link_to(__('delete'), 'sfBlogAdmin/deleteComment?id='.$comment->getId(), array('class' => 'decrease')) ?></li>
  </ul>
</div>
