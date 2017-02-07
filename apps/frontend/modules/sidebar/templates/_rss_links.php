<ul id="rss_links">
  <li><?php echo sf_link_to(__s('featured questions'), '@frontpage_questions') ?> </li>
  <li><?php echo sf_link_to(__s('popular questions'), '@popular_questions') ?> <?php echo link_to_rss('popular questions', 'feed/popular') ?></li>
  <li><?php echo sf_link_to(__s('latest questions'), '@recent_questions') ?> <?php echo link_to_rss('latest questions', '@feed_recent_questions') ?></li>
  <li><?php echo sf_link_to(__s('latest answers'), '@recent_answers') ?> <?php echo link_to_rss('latest answers', '@feed_recent_answers') ?></li>
</ul>
