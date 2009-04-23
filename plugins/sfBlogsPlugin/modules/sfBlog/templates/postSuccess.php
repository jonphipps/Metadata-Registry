<?php use_helper('I18N') ?>
<?php $sf_response->setTitle($blog->getTitle().' > '.$post->getTitle()) ?>

<?php if(sfConfig::get('app_sfBlogs_use_feeds', true)): ?>
  <?php slot('auto_discovery_link_tag') ?>
    <?php echo auto_discovery_link_tag(
      'rss', 
      url_for('post', array('sf_subject' => $post, 'format' => 'atom1')),
      array('title' => __('Comments on post "%1%" from "%2%"', array('%1%' => $post->getTitle(), '%2%' => $blog->getTitle())))
    ) ?>
  <?php end_slot() ?>
<?php endif; ?>

<span class="sfBlog">

  <?php include_partial('sfBlog/post', array(
    'post'          => $post,
    'mode'          => 'full',
    'sf_cache_key'  => $post->getId() . 'full'
  )) ?>
  
  <div class="comments" id="comments">

    <?php if($nb_comments = count($comments)): ?>
      <h3>
        <?php echo format_number_choice('[1]One comment so far|(1,+Inf]%1% comments so far', array('%1%' => $nb_comments), $nb_comments) ?>
      </h3>
    <?php endif; ?>
    <div id="sfBlog_comment_list">
      <?php include_partial('sfBlog/comment_list', array(
        'post' => $post, 
        'comments' => $comments
      )) ?>
    </div>

  </div>

</span>

<?php include_partial('sfBlog/blogSidebar', array('blog' => $blog)) ?>
<?php include_partial('sfBlog/blogFooter', array('blog' => $blog)) ?>
