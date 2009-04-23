<h2><?php echo __('Feeds') ?></h2>
<ul>
<li><?php echo link_to(__('Posts (RSS)'), 'sfBlog/posts?format=rss') ?></li>
<li><?php echo link_to(__('Posts (Atom)'), 'sfBlog/posts?format=atom1') ?></li>
<li><?php echo link_to(__('Comments (RSS)'), 'sfBlog/comments?format=rss') ?></li>
<li><?php echo link_to(__('Comments (Atom)'), 'sfBlog/comments?format=atom1') ?></li>
</ul>