<?php use_javascript('/sfBlogsPlugin/admin/js/blogEditBehaviors.js') ?>
<?php use_helper('Object', 'I18N') ?>
<?php $sf_response->setTitle($blog->isNew() ? __('New Blog') : __('Edit Blog "%title%"', array('%title%' => $blog->getTitle()))) ?>

<?php slot('main_form') ?>
  <?php echo form_tag('sfBlogAdmin/blogEdit', array('id' => 'edit_object_form')) ?>
<?php end_slot() ?>

<?php slot('main_form_end') ?>
  </form>
<?php end_slot() ?>

<?php slot('toolbar') ?>
<?php if ($sf_user->hasFlash('notice')): ?>
<div id="notice">
  <?php echo __($sf_user->getFlash('notice')) ?>
</div>
<?php endif; ?>
<ul class="buttons">
  <li class="active"><?php echo submit_tag(__('Save'), 'name=save id=ok_button') ?></li>
  <li class="active undo"><?php echo link_to(__('Return to list'), 'sfBlogAdmin/blogs', array('confirm' => __("Are you sure?\nAll unsaved changes will be lost."))) ?></li>
  <?php if (!$blog->isNew()): ?>
    <li class="active blog_delete"><?php echo link_to(__('Delete'), 'sfBlogAdmin/blogDelete?id='.$blog->getId(), array('confirm' => __("Are you sure ?\nThis will delete the blog and all its posts and comments."))) ?></li>
  <?php endif ?>
  
</ul>
<?php end_slot() ?>

<fieldset id="various_fields">
  
  <?php echo input_hidden_tag('id', $blog->getId()) ?>
  
  <div class="form-row">
    <?php echo label_for('blog[title]', __('Title:')) ?>
    <div class="content">
    <?php echo object_input_tag($blog, 'getTitle', array(
      'size' => 80,
      'control_name' => 'blog[title]'
    )) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('blog[stripped_title]', __('Url:')) ?>
    <div class="content">
    <?php echo object_input_tag($blog, 'getStrippedTitle', array(
      'size' => 80,
      'control_name' => 'blog[stripped_title]'
    )) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('blog[tagline]', __('Description:')) ?>
    <div class="content">
    <?php echo object_textarea_tag($blog, 'getTagline', array(
      'size' => '80x2',
      'control_name' => 'blog[tagline]'
    )) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('blog[copyright]', __('Copyright:')) ?>
    <div class="content">
    <?php echo object_textarea_tag($blog, 'getCopyright', array(
      'size' => '80x2',
      'control_name' => 'blog[copyright]'
    )) ?>
    </div>
  </div>

  <?php if (!$blog->isNew()): ?>
    <div class="form-row">
      <label><?php echo __('Authors:') ?></label>
      <div class="content">
        <ul id="blog_authors">
        <?php foreach ($blog->getUsers() as $user): ?>
          <li>
            <?php echo $user ?>
            <?php if ($type = $blog->canRemove($sf_user->getGuardUser(), $user)): ?>
              <?php echo link_to('remove', 'sfBlogAdmin/removeAuthor?id='.$blog->getId().'&username='.$user->getUsername(), $type == 1 ? 'class=ajax_removable' : '') ?>
            <?php endif ?>
          </li>
        <?php endforeach ?>
        <?php if ($blog->IsCreator($sf_user->getGuardUser())): ?>
          <li><?php echo link_to('Add a new author', 'sfBlogAdmin/addBlogUser?id='.$blog->getId()) ?> </li>
        <?php endif ?>
        </ul>
      </div>
    </div>
  <?php endif ?>

  <div class="form-row">
    <?php echo label_for('blog[comment_policy]', __('Comment policy:')) ?>
    <div class="content">
      <?php echo select_tag('blog[comment_policy]', options_for_select(array(
        0 => 'Comments are not allowed',
        1 => 'Comments must be reviewed before publication',
        2 => 'Comments must be reviewed if the author never commented',
        3 => 'All comments are published directly'
      ), $blog->getCommentPolicy())) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('blog[display_extract]', __('Display extract:')) ?>
    <div class="content">
      <?php echo object_checkbox_tag($blog, 'getDisplayExtract', array(
        'control_name' => 'blog[display_extract]'
      )) ?>
    </div>
  </div>

  <div class="form-row">
    <?php echo label_for('blog[is_finished]', __('Finished:')) ?>
    <div class="content">
      <?php echo object_checkbox_tag($blog, 'getIsFinished', array(
        'control_name' => 'blog[is_finished]'
      )) ?>
    </div>
  </div>

</fieldset>


