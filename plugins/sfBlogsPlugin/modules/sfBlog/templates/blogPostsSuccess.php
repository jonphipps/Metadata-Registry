<?php use_helper('I18N', 'Date', 'sfBlog') ?>
<?php $raw_params = $params instanceof sfOutputEscaper ? $params->getRaw() : $params ?>
<?php $http_params = http_build_query($raw_params) ?>
<?php $title = get_post_list_title($raw_params, $sf_params->get('page')) ?>

<?php if(sfConfig::get('app_sfBlogs_use_feeds', true)): ?>
  <?php slot('auto_discovery_link_tag') ?>
    <?php echo auto_discovery_link_tag('rss', 'sfBlog/blogPosts?format=atom1&'.$http_params, array('title' => get_post_list_title($raw_params, null, $blog))) ?>
  <?php end_slot() ?>
<?php endif; ?>

<?php $sf_response->setTitle($blog->getTitle() . ' > ' . $title) ?>

<h3><?php echo $title ?></h3>

<?php if($post_pager->haveToPaginate() && $post_pager->getPage() != 1): ?>
  <?php echo link_to(__('< earlier posts'), 'sfBlog/blogPosts?'.$http_params.'&page='.$post_pager->getPreviousPage()) ?>
<?php endif; ?>

<span class="sfBlog">
<?php foreach($post_pager->getResults() as $post): ?>
  <?php include_partial('sfBlog/post', array(
    'post'      => $post,
    'mode'      => $blog->getListMode(),
    'with_blog' => false,
    'sf_cache_key'  => $post->getId() . 'short1'
  )) ?>
<?php endforeach; ?>
</span>

<?php if($post_pager->haveToPaginate() && $post_pager->getPage() != $post_pager->getLastPage()): ?>
  <?php echo link_to(__('older posts >'), 'sfBlog/blogPosts?'.$http_params.'&page='.$post_pager->getNextPage()) ?>
<?php endif; ?>

<?php include_partial('sfBlog/blogSidebar', array('blog' => $blog)) ?>
<?php include_partial('sfBlog/blogFooter', array('blog' => $blog)) ?>
