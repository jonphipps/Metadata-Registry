<?php use_helper('Validation') ?>
<h3><?php echo __('Add a comment') ?></h3>
<?php echo form_tag('sfBlog/addComment', 'name=add_comment class=add_comment id=sfBlog_add_comment_form') ?>
  <?php echo input_hidden_tag('blog_title', $post->getsfBlog()->getStrippedTitle()) ?>
  <?php echo input_hidden_tag('stripped_title', $post->getStrippedTitle()) ?>
  <?php echo input_hidden_tag('date', $post->getPublishedAt()) ?>
  <div class="form_control">
    <?php echo form_error('name') ?>
    <?php echo input_tag('name', '', 'id= class=text') ?>
    <label for="name"><?php echo __('Name (required)') ?></label>
  </div>
  <div class="form_control">
    <?php echo form_error('mail') ?>
    <?php echo input_tag('mail', '', 'id= class=text') ?>
    <label for="mail"><?php echo __('Mail (required) (will not be published)') ?></label>
  </div>
  <div class="form_control">
    <?php echo form_error('website') ?>
    <?php echo input_tag('website', '', 'id= class=text') ?>
    <label for="url"><?php echo __('Website') ?></label>
  </div>
  <div class="form_control">
    <?php echo form_error('content') ?>
    <?php echo textarea_tag('content', '', 'id=') ?>
    <label for="content"></label>
  </div>
  <div class="form_control">
    <?php echo submit_tag(__('Submit comment')) ?>
  </div>
</form>

<?php if(sfConfig::get('app_sfBlogs_use_ajax', true)): ?>
<?php use_javascript('/sfBlogsPlugin/js/jquery.js') ?>
<script type="text/javascript" charset="utf-8">
//<![CDATA[
jQuery(function($){
  $('#sfBlog_add_comment_form').submit(function(){
    var the_form = $(this);
    $('#sfBlog_comment_list').load(the_form.attr('action'), the_form.serializeArray());
    return false;
  });
});
//]]>
</script>
<?php endif; ?>