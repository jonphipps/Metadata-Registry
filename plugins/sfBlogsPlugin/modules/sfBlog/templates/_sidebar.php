<?php slot('sfBlog_sidebar') ?>

  <?php foreach(sfConfig::get('app_sfBlogs_sidebar', array('custom', 'blog_recent_posts', 'archives', 'tags', 'feeds', 'blogroll', 'meta')) as $widget): ?>

    <?php if($widget == 'feeds' && sfConfig::get('app_sfBlogs_use_feeds', true)): ?>
      <?php include_partial('sfBlog/feed') ?>
    <?php elseif($widget == 'archives'): ?>
      <?php include_component('sfBlog', 'archives') ?>
    <?php elseif($widget == 'tags'): ?>
      <?php include_component('sfBlog', 'tagList') ?>
    <?php elseif($widget == 'blog_recent_posts'): ?>
      <?php include_component('sfBlog', 'recentPosts') ?>
    <?php elseif($widget == 'meta'): ?>
      <?php include_partial('sfBlog/meta') ?>
    <?php elseif($widget == 'blogroll'): ?>
      <?php include_partial('sfBlog/blogroll') ?>
    <?php else: ?>
      <?php echo sfConfig::get('app_sfBlogs_'.$widget) ?>
    <?php endif; ?>
    
  <?php endforeach; ?>
<?php end_slot() ?>