<?php foreach ($pager->getResults() as $post): ?>
  <?php include_partial('sfBlogadmin/post', array('post' => $post)) ?>
<?php endforeach; ?>
