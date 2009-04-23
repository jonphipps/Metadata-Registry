<?php use_helper('I18N', 'Date') ?>
<?php $sf_context->getResponse()->setTitle(sfConfig::get('app_sfBlogs_title', 'All Blogs')) ?>

<?php if(sfConfig::get('app_sfBlogs_use_feeds', true)): ?>
<?php slot('auto_discovery_link_tag') ?>
  <?php echo auto_discovery_link_tag('rss', 'sfBlog/posts?format=atom1', array('title' => __('Latests posts'))) ?>
<?php end_slot() ?>
<?php endif; ?>

<?php if($post_pager->haveToPaginate() && $post_pager->getPage() != 1): ?>
  <?php echo link_to(__('< earlier posts'), 'sfBlog/index?page='.$post_pager->getPreviousPage()) ?>
<?php endif; ?>
<div class="sfBlog">
<?php if ($post_pager->getFirstIndice() == 1): ?>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr><td colspan="2" valign="top">
      <?php if($post = array_shift($posts)): ?>
        <?php include_partial('sfBlog/post', array(
          'post'          => $post,
          'mode'          => 'short',
          'with_blog'     => true,
          'sf_cache_key'  => $post->getId() . 'short1'
        )) ?>
      <?php endif; ?>
    </td></tr>
    <tr>
      <td valign="top" style="padding-right:5px;width:50%">
        <?php if($post = array_shift($posts)): ?>
          <?php include_partial('sfBlog/post', array(
            'post'          => $post,
            'mode'          => 'short',
            'with_blog'     => true,
            'sf_cache_key'  => $post->getId() . 'short1'
          )) ?>
        <?php endif; ?>
      </td>
      <td valign="top" style="padding-left:5px;width:50%">
        <?php if($post = array_shift($posts)): ?>
          <?php include_partial('sfBlog/post', array(
            'post'          => $post,
            'mode'          => 'short',
            'with_blog'     => true,
            'sf_cache_key'  => $post->getId() . 'short1'
          )) ?>
        <?php endif; ?>
      </td>
    </tr>
  </table>
<?php endif ?>

<?php foreach($posts as $post): ?>
  <?php include_partial('sfBlog/post', array(
    'post'          => $post,
    'mode'          => 'tiny',
    'with_blog'     => true,
    'sf_cache_key'  => $post->getId() . 'tiny1'
  )) ?>
<?php endforeach; ?>
</div>

<?php if($post_pager->haveToPaginate() && $post_pager->getPage() != $post_pager->getLastPage()): ?>
  <?php echo link_to(__('older posts >'), 'sfBlog/index?page='.$post_pager->getNextPage()) ?>
<?php endif; ?>

<?php include_partial('sfBlog/sidebar') ?>
<?php include_partial('sfBlog/footer') ?>