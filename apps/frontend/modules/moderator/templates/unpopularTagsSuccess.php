<h1><?php echo __s('unpopular tags') ?></h1>

<ul>
<?php foreach ($tags as $tag => $count): ?>
  <li><?php echo $tag.' ('.$count.')' ?> <?php echo sf_link_to('['.__s('delete tag').']', 'moderator/deleteTag?tag='.$tag, 'confirm='.__s('Are you sure you want to delete this tag?')) ?></li>
<?php endforeach ?>
</ul>
