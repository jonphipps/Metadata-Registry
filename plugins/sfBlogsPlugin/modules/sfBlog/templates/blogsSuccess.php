<?php use_helper('I18N', 'Date', 'sfBlog') ?>

<?php $title = __('Blogs') ?>

<?php $sf_response->setTitle($title) ?>

<h3><?php echo $title ?></h3>

<?php if($blog_pager->haveToPaginate() && $blog_pager->getPage() != 1): ?>
  <?php echo link_to(__('< previous blogs'), 'sfBlog/blogs?page='.$blog_pager->getPreviousPage()) ?>
<?php endif; ?>

<span class="sfBlog">
<?php foreach($blog_pager->getResults() as $blog): ?>
  <div class="blog">
    <h2>
      <?php echo link_to($blog->getTitle(), 'sfBlog/blogPosts?stripped_title='.$blog->getStrippedTitle()) ?>
    </h2>
    <div class="details">
      <div class="tagline">
        <?php echo $blog->getTagline() ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</span>

<?php if($blog_pager->haveToPaginate() && $blog_pager->getPage() != $post_pager->getLastPage()): ?>
  <?php echo link_to(__('more blogs >'), 'sfBlog/blogs?page='.$blog_pager->getNextPage()) ?>
<?php endif; ?>

<?php include_partial('sfBlog/sidebar') ?>
<?php include_partial('sfBlog/footer') ?>
