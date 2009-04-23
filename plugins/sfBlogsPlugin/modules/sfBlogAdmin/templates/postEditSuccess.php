<?php use_javascript('/sfBlogsPlugin/admin/wymeditor/jquery.wymeditor.js') ?>
<?php use_javascript('/sfBlogsPlugin/admin/js/postEditBehaviors.js') ?>
<?php use_helper('Object', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php if ($post->isNew()): ?>
<?php $sf_response->setTitle(__('New Post')) ?>
<?php else: ?>
<?php $sf_response->setTitle(__('Edit Post "%post%"', array('%post%' => $post->getTitle()))) ?>
<?php endif ?>
<?php slot('main_form') ?>
  <?php echo form_tag('sfBlogAdmin/postEdit', array(
    'id'        => 'edit_object_form',
    'name'      => 'edit_post_form'
  )) ?>
<?php end_slot() ?>

<?php slot('toolbar') ?>
<?php if ($sf_user->hasFlash('notice')): ?>
<div id="notice">
  <?php echo __($sf_user->getFlash('notice')) ?>
</div>
<?php endif; ?>
<ul class="buttons">
  <?php if ($post->getIsPublished()): ?>
    <li class="active post_publish"><?php echo submit_tag(__('Update'), 'name=save class=wymupdate') ?></li>
    <li class="active post_draft"><?php echo submit_tag(__('Unpublish'), 'name=draft class=wymupdate') ?></li>
  <?php else: ?>
    <li class="active post_publish"><?php echo submit_tag(__('Publish'), 'name=save class=wymupdate') ?></li>
    <li class="active post_draft"><?php echo submit_tag($post->isNew() ? __('Save Draft') : __('Update Draft'), 'name=draft class=wymupdate') ?></li>
  <?php endif ?>
  <?php if (!$post->isNew()): ?>
    <li class="active post_preview"><?php echo submit_tag(__('Preview'), 'name=preview class=wymupdate') ?></li>
  <?php endif ?>
  <li class="active undo"><?php echo link_to(__('Return to list'), 'sfBlogAdmin/posts', array('confirm' => __("Are you sure?\nAll unsaved changes will be lost."))) ?></li>
  <?php if (!$post->isNew()): ?>
    <li class="active post_delete"><?php echo link_to(__('Delete'), 'sfBlogAdmin/postDelete?id='.$post->getId(), array('confirm' => __("Are you sure ?\nThis will delete the post and all its comments."))) ?></li>
  <?php endif ?>
</ul>
<?php end_slot() ?>

<?php echo object_input_hidden_tag($post, 'getId') ?>

<fieldset id="various_fields">

  <div class="form-row">
    <?php echo label_for('post[title]', __('Title:'), '') ?>
    <div class="content">
    <?php echo object_input_tag($post, 'getTitle', array(
      'size' => 80,
      'control_name' => 'post[title]'
    )) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('post[extract]', __('Extract:'), '') ?>
    <div class="content">
    <?php echo object_textarea_tag($post, 'getExtract', array(
      'size' => '30x3',
      'control_name' => 'post[extract]'
    )) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('post[tags_as_string]', __('Tags:'), '') ?>
    <div class="content">
    <?php echo object_input_tag($post, 'getTagsAsString', array(
      'control_name' => 'post[tags_as_string]',
    )) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('post[blog_id]', __('Blog:'), '') ?>
    <div class="content">
    <?php echo select_tag('post[blog_id]', objects_for_select($blogs, 'getId', 'getTitle', $post->getsfBlogId())) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('post[author_id]', __('Author:'), '') ?>
    <div class="content">
    <?php echo object_select_tag($post, 'getAuthorId', array(
      'related_class' => 'sfGuardUser',
      'control_name' => 'post[author_id]'
    ), $sf_user->getGuardUser()->getId()) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('post[allow_comments]', __('Allow comments:'), '') ?>
    <div class="content">
    <?php echo object_checkbox_tag($post, 'getAllowComments', array(
      'control_name' => 'post[allow_comments]'
    )) ?>
    </div>
  </div>

</fieldset>

<?php echo object_textarea_tag($post, 'getContent', array(
  'size' => '60x20',
  'control_name' => 'post[content]'
)) ?>

<?php slot('main_form_end') ?>
</form>
<?php end_slot() ?>


