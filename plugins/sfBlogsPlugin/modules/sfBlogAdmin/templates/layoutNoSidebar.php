<?php use_helper('I18N') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-200000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php echo stylesheet_tag('/sfBlogsPlugin/admin/css/layout.css') ?>
    <?php echo stylesheet_tag('/sfBlogsPlugin/admin/css/main.css') ?>
    <?php echo include_http_metas() ?>
    <?php echo include_metas() ?>
    <?php echo include_title() ?>
    <?php include_slot('auto_discovery_link_tag') ?>
    <link rel="shortcut icon" href="/favicon.ico">
  </head>
  <body>
    <div id="loader">
      <?php echo image_tag('/sfBlogsPlugin/admin/images/ajax-loader.gif') ?>
    </div>
    <?php include_slot('main_form') ?>
    <div id="header">
      <?php include_component('sfBlogAdmin', 'mainNavigation', array('action' => $sf_params->get('action'))) ?>
      <div id="toolbar">
        <?php include_slot('toolbar') ?>
      </div>
    </div>
    <div id="content">
      <?php echo $sf_data->getRaw('sf_content') ?>
    </div>
    <?php include_slot('main_form_end') ?>
    <?php echo javascript_include_tag('/sfBlogsPlugin/js/jquery.js') ?>
    <?php include_javascripts() ?>
  </body>
</html>