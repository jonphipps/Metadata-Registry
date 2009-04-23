<?php use_javascript('/sfBlogsPlugin/admin/js/jquery.autopager.js') ?>
<?php use_javascript('/sfBlogsPlugin/admin/js/commentsBehaviors.js') ?>
<?php $sf_response->setTitle('Comments') ?>
<?php use_helper('I18N') ?>

<?php slot('main_form') ?>
<?php echo form_tag('sfBlogAdmin/comments', array('method' => 'get', 'id' => 'comment_filter_form', 'class' => 'filter')) ?>
<?php echo input_hidden_tag('filter', 'filter') ?>
<?php end_slot() ?>

<?php slot('main_form_end') ?>
</form>
<?php end_slot() ?>

<?php slot('toolbar') ?>
<div class="end">
  <?php echo input_tag('filters[text]', isset($filters['text']) && $filters['text'] ? $filters['text'] : __('search')) ?>
</div>
<?php end_slot() ?>

<?php slot('navigation') ?>
  <?php include_component('sfBlogAdmin', 'commentFilter', array('filters' => $filters)) ?>
<?php end_slot() ?>

<?php use_helper('I18N') ?>
<div id="list">
  <div class="list_details"><span id="nb_results"><?php echo $pager->getNbResults() ?></span> <?php echo __('comments') ?></div>
  <div class="items">
    <?php include_partial('sfBlogAdmin/commentList', array('pager' => $pager)) ?>
  </div>
</div>

<script type="text/javascript" charset="utf-8">
//<![CDATA[
var current_page = <?php echo $pager->getPage() ?>;
var max_page = <?php echo $pager->getLastPage() ?>;
var initial_search = '<?php echo __('search') ?>';
//]]>
</script>