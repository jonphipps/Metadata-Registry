<?php use_javascript('/sfBlogsPlugin/admin/js/jquery.autopager.js') ?>
<?php use_javascript('/sfBlogsPlugin/admin/js/blogsBehaviors.js') ?>
<?php use_helper('I18N') ?>
<?php $sf_response->setTitle(__('Blogs')) ?>

<?php slot('toolbar') ?>
<ul class="buttons">
  <li class="active blog_new"><?php echo link_to(__('New blog'), 'sfBlogAdmin/blogEdit') ?></li>
  <li class="contextual blog_edit"><a><?php echo __('Edit') ?></a></li>
  <li class="contextual blog_delete"><a><?php echo __('Delete') ?></a></li>
</ul>
<?php end_slot() ?>

<?php slot('navigation') ?>
  <?php include_component('sfBlogAdmin', 'blogFilter', array('selected' => $sf_params->get('id'))) ?>
<?php end_slot() ?>

<script type="text/javascript" charset="utf-8">
//<![CDATA[
var preview_url = '<?php echo url_for('sfBlogAdmin/blogPreview') ?>';
var delete_message = '<?php echo __('Are you sure you want to delete this blog?') ?>';
var delete_url = '<?php echo url_for('sfBlogAdmin/blogDelete') ?>';
//]]>
</script>

<div id="preview">
</div>