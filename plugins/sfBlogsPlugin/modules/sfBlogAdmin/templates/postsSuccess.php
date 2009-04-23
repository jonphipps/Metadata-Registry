<?php use_javascript('/sfBlogsPlugin/admin/js/jquery.autopager.js') ?>
<?php use_javascript('/sfBlogsPlugin/admin/js/jquery.datagrid.js') ?>
<?php use_javascript('/sfBlogsPlugin/admin/js/postsBehaviors.js') ?>
<?php use_helper('I18N') ?>

<?php $sf_response->setTitle('Posts') ?>

<?php if (!$hasBlog): ?>
  <div class="invite"><?php echo __('In order to be able to write a post, you must first %link%.', array('%link%' => link_to(__('create a blog'), 'sfBlogAdmin/blogEdit'))) ?></div>
  <?php return ?>
<?php endif ?>

<?php slot('main_form') ?>
<?php echo form_tag('sfBlogAdmin/posts', array('method' => 'get', 'id' => 'post_filter_form', 'class' => 'filter')) ?>
<?php echo input_hidden_tag('filter', 'filter') ?>
<?php end_slot() ?>

<?php slot('main_form_end') ?>
</form>
<?php end_slot() ?>

<?php slot('toolbar') ?>
<div class="end">
<?php echo input_tag('filters[text]', isset($filters['text']) && $filters['text'] ? $filters['text'] : __('search')) ?>
</div>
<ul class="buttons">
  <li class="active post_add"><?php echo link_to(__('New post'), 'sfBlogAdmin/postEdit') ?></li>
  <li class="contextual post_edit"><a><?php echo __('Edit') ?></a></li>
  <li class="contextual publish draft"><a><?php echo __('Publish') ?></a></li>
  <li class="contextual post_delete"><a><?php echo __('Delete') ?></a></li>
</ul>
<?php end_slot() ?>

<?php slot('navigation') ?>
<?php include_component('sfBlogAdmin', 'postFilter', array('filters' => $filters)) ?>
<?php end_slot() ?>

<div id="list" class="scrollable">
  <table border="0" cellspacing="0" cellpadding="0" class="list">
    <thead>
      <tr>
        <th width="35%" class="<?php echo $sort['sort'] == 'title' ? $sort['type'] : '' ?>">
          <?php echo link_to(__('Title'), 'sfBlogAdmin/posts', array(
            'query_string' => 'sort=title&type='.($sort['sort'] == 'title' ? ($sort['type'] == 'asc' ? 'desc' : 'asc') : 'asc')
          )) ?>
        </th>
        <th width="20%" class="<?php echo $sort['sort'] == 'blog' ? $sort['type'] : '' ?>">
          <?php echo link_to(__('Blog'), 'sfBlogAdmin/posts', array(
            'query_string' => 'sort=blog&type='.($sort['sort'] == 'blog' ? ($sort['type'] == 'asc' ? 'desc' : 'asc') : 'asc')
          )) ?>
        </th>
        <th width="10%" class="<?php echo $sort['sort'] == 'author' ? $sort['type'] : '' ?>">
          <?php echo link_to(__('Author'), 'sfBlogAdmin/posts', array(
            'query_string' => 'sort=author&type='.($sort['sort'] == 'author' ? ($sort['type'] == 'asc' ? 'desc' : 'asc') : 'asc')
          )) ?>
        </th>
        <th width="15%"><?php echo __('Tags') ?></th>
        <th width="10%" class="inverted <?php echo $sort['sort'] == 'default' ? $sort['type'] : '' ?>">
          <?php echo link_to(__('Published at'), 'sfBlogAdmin/posts', array(
            'query_string' => 'sort=default&type='.($sort['sort'] == 'default' ? ($sort['type'] == 'asc' ? 'desc' : 'asc') : 'desc')
          )) ?>
        </th>
        <th width="10%" class="<?php echo $sort['sort'] == 'nb_comments' ? $sort['type'] : '' ?>">
          <?php echo link_to(__('Nb comments'), 'sfBlogAdmin/posts', array(
            'query_string' => 'sort=nb_comments&type='.($sort['sort'] == 'nb_comments' ? ($sort['type'] == 'asc' ? 'desc' : 'asc') : 'asc')
          )) ?>
        </th>
      </tr>
    </thead>
    <tbody class="items">
      <?php include_partial('sfBlogAdmin/postList', array('pager' => $pager)) ?>
    </tbody>
  </table>
</div>
<div id="preview">
</div>
<div></div> <?php // this empty div is necessary for the splitter, and becomes the separator ?>

<?php echo input_hidden_tag('sort', $sort['sort']) ?>
<?php echo input_hidden_tag('type', $sort['type']) ?>

<script type="text/javascript" charset="utf-8">
//<![CDATA[
var current_page = <?php echo $pager->getPage() ?>;
var max_page = <?php echo $pager->getLastPage() ?>;
var initial_search = '<?php echo __('search') ?>';
var preview_url = '<?php echo url_for('sfBlogAdmin/postPreview') ?>';
var delete_message = '<?php echo __('Are you sure you want to delete this post?') ?>';
var delete_url = '<?php echo url_for('sfBlogAdmin/postDelete') ?>';
var publish_message = '<?php echo __('Are you sure?') ?>';
var publish_url = '<?php echo url_for('sfBlogAdmin/togglePublishPost') ?>';
//]]>
</script>