<?php echo stylesheet_tag('/sfBlogsPlugin/css/blog.css') ?>
<?php use_helper('I18N', 'sfBlog') ?>
<div class="sfBlog">
  <h1><?php echo link_to_blog($blog) ?></h1>
  <div id="tagline">
    <?php echo $blog->getTagline() ?>
  </div>
  <?php if ($blog->getIsFinished()): ?>
    <div><?php echo __('Finished (no more posts)') ?></div>
  <?php endif ?>
  <div id="stats">
    <p>
      <?php echo image_tag('/sfBlogsPlugin/admin/images/page_white_stack', 'align=absbottom') ?>
      <?php echo link_to(
        __('%nb% posts', array('%nb%' => $blog->countsfBlogPosts())),
        'sfBlogAdmin/posts',
        array('query_string' => 'filter=filter&filters[blog_id]='.$blog->getId())
      ) ?>
      <?php echo link_to(
        __('(%nb% drafts)', array('%nb%' => $blog->countDraftPosts())),
        'sfBlogAdmin/posts',
        array('query_string' => 'filter=filter&filters[is_published]=0&filters[blog_id]='.$blog->getId())
      ) ?>
    </p>
    <p>
      <?php echo image_tag('/sfBlogsPlugin/admin/images/comments', 'align=absbottom') ?>
      <?php echo link_to(
        __('%nb% comments', array('%nb%' => $blog->countComments())),
        'sfBlogAdmin/comments',
        array('query_string' => 'filter=filter&filters[parent_id]=blog_'.$blog->getId())
      ) ?>
      <?php echo link_to(
        __('(%nb% to moderate)', array('%nb%' => $blog->countCommentsToModerate())),
        'sfBlogAdmin/comments',
        array('query_string' => 'filter=filter&filters[status]=pending&filters[parent_id]=blog_'.$blog->getId())
      ) ?>
    </p>
    <p>
      <?php echo image_tag('/sfBlogsPlugin/admin/images/group', 'align=absbottom') ?>
      <?php echo __('Authors:') ?> <?php echo join($blog->getUsers(), ', ') ?>
    </p>
  </div>
</div>
