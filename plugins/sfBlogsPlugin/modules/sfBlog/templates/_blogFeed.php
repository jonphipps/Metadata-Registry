<h2><?php echo __('Feeds') ?></h2>
<ul>
<li><?php echo link_to(__('Posts (RSS)'), 'blog', array('sf_subject' => $blog, 'format' => 'rss')) ?></li>
<li><?php echo link_to(__('Posts (Atom)'), 'blog', array('sf_subject' => $blog, 'format' => 'atom1')) ?></li>
<li><?php echo link_to(__('Comments (RSS)'), 'blog_comments', array('sf_subject' => $blog, 'format' => 'rss')) ?></li>
<li><?php echo link_to(__('Comments (Atom)'), 'blog_comments', array('sf_subject' => $blog, 'format' => 'atom1')) ?></li>
</ul>