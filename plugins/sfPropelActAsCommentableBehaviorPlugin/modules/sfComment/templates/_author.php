<?php
if (isset($author_website) 
    && !is_null($author_website) 
    && ('' != $author_website)):
?>
  <?php
  echo link_to(trim(rtrim($author)), 
               $author_website, 
               array('rel' => 'nofollow'));
  ?>
<?php else: ?>
  <?php echo trim(rtrim($author)); ?>
<?php endif; ?>