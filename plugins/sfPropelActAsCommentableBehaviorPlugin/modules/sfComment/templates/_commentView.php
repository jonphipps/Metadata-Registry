<?php use_helper('I18N'); ?>
<?php use_helper('Date'); ?>
<div class="sf_comment" id="sf_comment_<?php echo $comment['Id'] ?>">
  <?php if (sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_use_gravatar', true)): ?>
    <?php if (!is_null($comment['AuthorId'])): ?>
      <?php
      include_component('sfComment',
                        'gravatar',
                        array('author_id'    => $comment['AuthorId'],
                              'sf_cache_key' => $comment['AuthorId']));
      ?>
    <?php else: ?>
      <?php
      include_component('sfComment',
                        'gravatar',
                        array('author_name'    => $comment['AuthorName'],
                              'author_email' => $comment['AuthorEmail'],
                              'sf_cache_key'   => $comment['AuthorEmail']));
      ?>
    <?php endif; ?>
  <?php endif; ?>
  <p class="sf_comment_info">
    <?php
    if (!is_null($comment['AuthorId']))
    {
      $author = get_component('sfComment',
                              'author',
                              array('author_id'    => $comment['AuthorId'],
                                    'sf_cache_key' => $comment['AuthorId']));
    }
    else
    {
      $author = get_component('sfComment',
                              'author',
                              array('author_name'    => $comment['AuthorName'],
                                    'author_website' => $comment['AuthorWebsite']));
    }

    $date_format = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_date_format', 'words');
    if ('words' == $date_format)
    {
      $date = __('%1% ago', array('%1%' => distance_of_time_in_words(strtotime($comment['CreatedAt']))));
    }
    else
    {
      $date = format_date(strtotime($comment['CreatedAt']), $date_format);
    }
    ?>
    <?php
    echo __('<span class="sf_comment_author">%1%</span>, <a href="#sf_comment_%2%">%3%</a>',
            array('%1%' => $author,
                  '%2%' => $comment['Id'],
                  '%3%' => $date))
    ?>
  </p>
  <div class="sf_comment_text">
    <?php echo $comment['Text']; ?>
  </div>
</div>