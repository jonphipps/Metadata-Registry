<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-200000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php use_stylesheet('/sfBlogsPlugin/css/layout.css') ?>
    <?php echo include_http_metas() ?>
    <?php echo include_metas() ?>
    <?php echo include_title() ?>
    <?php include_slot('auto_discovery_link_tag') ?>
    <link rel="shortcut icon" href="/favicon.ico">
  </head>
  <body>
    <div id="sfBlog_container">
      <div id="header">
        <ul>
          <li><?php echo link_to(__('Home'), 'sfBlog/index') ?></li>
          <li><?php echo link_to(__('Blogs'), 'sfBlog/blogs') ?></li>
        </ul>
      </div>
      <div id="sidebar-a">
        <?php include_slot('sfBlog_sidebar') ?>
      </div>
      <div id="content" >
        <?php echo $sf_data->getRaw('sf_content') ?>
      </div>
      <div id="footer">
         <?php include_slot('sfBlog_footer') ?>
      </div>
    </div>
  </body>
</html>