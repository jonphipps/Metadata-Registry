<?php use_helper('Date') ?>
<tr class="<?php echo $post->getIsPublished() ? 'published' : 'draft' ?>" id="post_<?php echo $post->getId() ?>">
  <td><?php echo link_to($post->getTitle(), 'sfBlogAdmin/postEdit?id='.$post->getId()) ?></td>
  <td><?php echo $post->getsfBlog() ?></td>
  <td><?php echo $post->getAuthor() ?></td>
  <td><?php echo $post->getTagsAsString() ?></td>
  <td><?php echo format_date($post->getPublishedAt('U')) ?></td>
  <td><?php echo $post->getNbComments() ?></td>
</tr>