<?php use_helper('sfBlog') ?>
<h2><?php echo __('Latest posts') ?></h2>
<ul>
<?php foreach($posts as $post): ?>
  <li>
    <?php echo link_to_post($post) ?> <br />
    in <?php echo link_to_blog($post->getsfBlog()) ?>
  </li>
<?php endforeach; ?>
</ul>