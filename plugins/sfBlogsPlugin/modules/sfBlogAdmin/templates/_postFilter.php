<?php use_helper('I18N') ?>

<?php $currentBlogId = null ?>
<ul id="tree_filter">
  <li class="level0 open"><?php echo link_to(__('Blogs'), 'sfBlogAdmin/posts', array(
    'query_string' => 'filter=filter&filters[blog_id]=',
    'class' => 'blog'
  )) ?>
  </li>
  <ul>
  <?php foreach ($blogs as $blog): ?>
    <li class="level1 blog">
      <?php echo link_to($blog->getTitle(), 'sfBlogAdmin/posts', array(
        'query_string' => 'filter=filter&filters[blog_id]='.$blog->getId(),
        'title' => $blog->getTitle(),
        'id' => 'filter_blog_'.$blog->getId(),
        'class' => 'blog'
      )) ?>
    </li>
  <?php endforeach ?>
  </ul>
  <li class="level0 open">
    <?php echo link_to(__('Status'), 'sfBlogAdmin/comments', array(
      'query_string' => 'filter=filter&filters[is_published]=',
      'class' => 'filter_is_published'
    )) ?>
  </li>
  <ul>
    <li class="level1 draft">
      <?php echo link_to(__('Draft'), 'sfBlogAdmin/comments', array(
        'query_string' => 'filter=filter&filters[is_published]=0',
        'class' => 'filter_is_published draft',
        'id' => 'filter_is_published_0'
      )) ?>
    </li>
    <li class="level1 published">
      <?php echo link_to(__('Published'), 'sfBlogAdmin/comments', array(
        'query_string' => 'filter=filter&filters[is_published]=1',
        'class' => 'filter_is_published',
        'id' => 'filter_is_published_1'
      )) ?>
    </li>
  </ul>
  <li class="level0 open">
    <?php echo link_to(__('Tags'), 'sfBlogAdmin/posts', array(
      'query_string' => 'filter=filter&filters[tag]=',
      'class' => 'tag'
    )) ?>
  </li>
  <ul>
  <?php foreach ($tags as $tag): ?>
    <li class="level1 tag">
      <?php echo link_to($tag->getTag(), 'sfBlogAdmin/posts', array(
        'query_string' => 'filter=filter&filters[tag]='.$tag->getTag(),
        'title' => $tag->getTag(),
        'id' => 'filter_tag_'.$tag->getTag(),
        'class' => 'tag'
      )) ?>
    </li>
  <?php endforeach ?>
  </ul>
</ul>

<?php echo input_hidden_tag('filters[blog_id]', isset($filters['blog_id']) ? $filters['blog_id'] : null) ?>
<?php echo input_hidden_tag('filters[tag]', isset($filters['tag']) ? $filters['tag'] : null) ?>
<?php echo input_hidden_tag('filters[is_published]', isset($filters['is_published']) ? $filters['is_published'] : null) ?>