<ul class="tabnav">
  <li class="<?php echo $action == 'index' ? 'active' : '' ?>">
    <?php echo link_to(__('Dashboard'), 'sfBlogAdmin/index') ?>
  </li>
  <li class="<?php echo ($action == 'posts' || $action == 'postEdit') ? 'active' : '' ?>">
    <?php echo link_to(__('Posts'), 'sfBlogAdmin/posts') ?>
    <?php if ($nb_draft_posts): ?>
      <div class="nb_items"><?php echo $nb_draft_posts ?></div>
    <?php endif ?>
  </li>
  <li class="<?php echo $action == 'comments' ? 'active' : '' ?>">
    <?php echo link_to(__('Comments'), 'sfBlogAdmin/comments') ?>
    <?php if ($nb_comments_to_moderate): ?>
      <div class="nb_items"><?php echo $nb_comments_to_moderate ?></div>
    <?php endif ?>
  </li>
  <li class="<?php echo ($action == 'blogs' || $action == 'blogEdit') ? 'active' : '' ?>">
    <?php echo link_to(__('Blogs'), 'sfBlogAdmin/blogs') ?>
  </li>
</ul>