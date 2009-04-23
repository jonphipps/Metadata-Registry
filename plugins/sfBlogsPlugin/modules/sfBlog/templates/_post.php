<?php use_helper('Date', 'sfBlog', 'I18N') ?>
<div class="post <?php echo $mode ?>">
  <h2>
    <?php if ($mode == 'full'): ?>
      <?php echo $post->getTitle() ?>
    <?php else: ?>
      <?php echo link_to_post($post) ?>
    <?php endif; ?>
  </h2>
  
  <div class="details">
  <?php echo __('Posted') ?>
  
  <?php if(isset($with_blog) && $with_blog): ?>
    <?php echo __('in %blog%', array(
      '%blog%' => link_to_blog($post->getsfBlog())
    )) ?>
  <?php endif; ?>
  
  <?php echo __('by %author% on %date%', array(
    '%author%' => $post->getAuthor(), 
    '%date%'   => format_date($post->getPublishedAt('U'))
  )) ?>
  
  <?php if($tags = $post->getsfBlogTags(null, null, ESC_RAW)): ?>
    <?php echo __('tagged %tags%', array(
      '%tags%' => get_tag_links($tags, $post->getsfBlog())
    )) ?>
  <?php endif; ?>
  
  </div>
  
  <?php if ($mode == 'normal' || $mode == 'full'): ?>
    <div class="content">
      <?php echo $post->getContent(ESC_RAW)?>
    </div>
  <?php elseif($mode == 'short'): ?>
    <div class="extract">
      <?php echo $post->getExcerpt()?>
    </div>
  <?php endif ?>
  
  <?php if ($mode != 'full' && ($post->getNbComments() || $post->getAllowComments())): ?>
    <div class="related_details">
    <?php echo link_to_post($post, format_number_choice('[0]Be the first to comment|[1]one comment|(1,+Inf]%1% comments', array('%1%' => $post->getNbComments()), $post->getNbComments()), '#comments') ?>
    </div>
  <?php endif ?>

</div>