<?php include_partial('sfBlogAdmin/commentList', array('pager' => $pager)) ?>
<script type="text/javascript" charset="utf-8">
//<![CDATA[
jQuery('#nb_results').text(<?php echo $pager->getNbResults() ?>);
current_page = <?php echo $pager->getPage() ?>;
max_page = <?php echo $pager->getLastPage() ?>;
jQuery('#content').trigger('watchScroll');
//]]>
</script>