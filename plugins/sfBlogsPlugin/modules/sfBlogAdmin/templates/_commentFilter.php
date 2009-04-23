<?php use_helper('I18N') ?>

<?php $currentBlogId = null ?>
<ul id="tree_filter">
  <li class="level0 open">
    <?php echo link_to(__('Blogs'), 'sfBlogAdmin/comments', array(
      'query_string' => 'filter=filter&filters[parent_id]=',
      'class' => 'filter_blog'
    )) ?>
  <ul>
  <?php foreach ($posts as $index => $post): ?>
    <?php if ($post->getsfBlogId() != $currentBlogId): $currentBlogId = $post->getsfBlogId() ?>
      <?php if ($index): ?>
          </ul>
        </li>
      <?php endif ?>
    <li class="level1 blog">
        <?php echo link_to($post->getsfBlog()->getTitle(), 'sfBlogAdmin/comments', array(
          'query_string' => 'filter=filter&filters[parent_id]=blog_'.$currentBlogId,
          'title' => $post->getsfBlog()->getTitle(),
          'id' => 'filter_blog_'.$currentBlogId,
          'class' => 'filter_blog'
        )) ?>
      <ul>
    <?php endif ?>
        <li class="level2 post">
          <?php echo link_to($post->getTitle(), 'sfBlogAdmin/comments', array(
            'query_string' => 'filter=filter&filters[parent_id]=post_'.$post->getId(),
            'title' => $post->getTitle(),
            'id' => 'filter_post_'.$post->getId(),
            'class' => 'filter_blog'
          )) ?>
        </li>
  <?php endforeach ?>
  <?php if ($index): ?>
      </ul>
    </li>
  <?php endif ?>
  </ul>
  <li class="level0 open">
    <?php echo link_to(__('Status'), 'sfBlogAdmin/comments', array(
      'query_string' => 'filter=filter&filters[status]=',
      'class' => 'filter_status'
    )) ?>
  </li>
  <ul>
    <li class="level1 pending">
      <?php echo link_to(__('Pending'), 'sfBlogAdmin/comments', array(
        'query_string' => 'filter=filter&filters[status]=pending',
        'class' => 'filter_status',
        'id' => 'filter_status_pending'
      )) ?>
    </li>
    <li class="level1 approved">
      <?php echo link_to(__('Approved'), 'sfBlogAdmin/comments', array(
        'query_string' => 'filter=filter&filters[status]=approved',
        'class' => 'filter_status',
        'id' => 'filter_status_approved'
      )) ?>
    </li>
    <li class="level1 spam">
      <?php echo link_to(__('Spam'), 'sfBlogAdmin/comments', array(
        'query_string' => 'filter=filter&filters[status]=spam',
        'class' => 'filter_status',
        'id' => 'filter_status_spam'
      )) ?>
    </li>
  </ul>
</ul>

<?php echo input_hidden_tag('filters[parent_id]', isset($filters['parent_id']) ? $filters['parent_id'] : null) ?>
<?php echo input_hidden_tag('filters[status]', isset($filters['status']) ? $filters['status'] : null) ?>