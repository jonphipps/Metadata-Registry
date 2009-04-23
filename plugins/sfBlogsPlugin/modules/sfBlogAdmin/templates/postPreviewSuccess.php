<?php echo stylesheet_tag('/sfBlogsPlugin/css/blog.css') ?>
<div class="sfBlog">
  <?php include_partial('sfBlog/post', array('post' => $post, 'mode' => 'normal')) ?>
</div>
