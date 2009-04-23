<?php echo use_helper('I18N') ?>
<?php slot('sfBlog_footer') ?>
<?php echo sfConfig::get('app_sfBlogs_copyright', __('Blogs hosted in this site have various copyright rules. Please refer to the page footer of each post for copyright.')) ?>
<?php end_slot() ?>