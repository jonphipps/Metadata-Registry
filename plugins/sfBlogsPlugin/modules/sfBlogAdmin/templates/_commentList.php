<?php foreach ($pager->getResults() as $comment): ?>
  <?php include_partial('sfBlogAdmin/comment', array('comment' => $comment)) ?>
<?php endforeach ?>
