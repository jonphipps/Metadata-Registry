<ul id="tree_filter">
  <li class="level0 open"><?php echo link_to(__('Blogs'), 'sfBlogAdmin/blogs', array(
    'class' => 'blog'
  )) ?>
  </li>
  <ul>
  <?php foreach ($blogs as $blog): ?>
    <li class="level1 blog">
      <?php echo link_to($blog->getTitle(), 'sfBlogAdmin/blogEdit', array(
        'query_string' => 'id='. $blog->getId(),
        'class' => $blog->getId() == $selected ? 'selected' : '',
        'id' => 'blog_' . $blog->getId()
      )) ?>
    </li>
  <?php endforeach; ?>
  </ul>
</ul>