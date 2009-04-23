<?php # Not really a new pager - just a well-styled partial for use with ?>
<?php # sfPager implementations (i.e. sfDoctrinePager). ?>
<?php # Pass $pager and $pagerUrl. $pagerUrl can have other parameters in ?>
<?php # the query string already. This partial will add the page parameter ?>
<?php # as appropriate. ?>

<div class="pk_pager_navigation">
  <?php // Work around various ways the pagers don't work when there is ?>
  <?php // no absolute need for pagination, since we like to display ?>
  <?php // the pager anyway ?>
  <?php if ($pager->getPage() == 0): ?>
    <?php $pager->setPage(1) ?>
  <?php endif ?>
	<?php if ($pager->getPage() == 1):?>
		<span class="pk_pager_navigation_image pk_pager_navigation_first pk_pager_navigation_disabled">First Page</span>	
	  <span class="pk_pager_navigation_image pk_pager_navigation_previous pk_pager_navigation_disabled">Previous Page</span>
	<?php else: ?>
		<a href="<?php echo url_for(pkUrl::addParams($pagerUrl, array("page" => 1))) ?>" class="pk_pager_navigation_image pk_pager_navigation_first">First Page</a>
  	<a href="<?php echo url_for(pkUrl::addParams($pagerUrl, array("page" => $pager->getPreviousPage()))) ?>" class="pk_pager_navigation_image pk_pager_navigation_previous">Previous Page</a>
	<?php endif ?>

  <?php // TBB: $pager->getLinks() generates an error message if there ?>
  <?php // is only one page sigh ?>
  <?php // This is a nasty workaround ?>
  <?php if ($pager->getNbResults() > 5): ?>
    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <span class="pk_page_navigation_number pk_pager_navigation_disabled"><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for(pkUrl::addParams($pagerUrl, array("page" => $page))) ?>" class="pk_page_navigation_number"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif ?>
	<?php if ($pager->getPage() >= $pager->getLastPage()):?>
	  <span class="pk_pager_navigation_image pk_pager_navigation_next pk_pager_navigation_disabled">Next Page</span>
		<span class="pk_pager_navigation_image pk_pager_navigation_last pk_pager_navigation_disabled">Last Page</span>	
	<?php else: ?>
	  <a href="<?php echo url_for(pkUrl::addParams($pagerUrl, array("page" => $pager->getNextPage()))) ?>" class="pk_pager_navigation_image pk_pager_navigation_next">Next Page</a>
  	<a href="<?php echo url_for(pkUrl::addParams($pagerUrl, array("page" => $pager->getLastPage()))) ?>" class="pk_pager_navigation_image pk_pager_navigation_last">Last Page</a>
	<?php endif ?>
</div>
