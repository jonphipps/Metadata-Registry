<?php include_partial('sfBlogAdmin/postList', array('pager' => $pager)) ?>
<script type="text/javascript" charset="utf-8">
//<![CDATA[
current_page = <?php echo $pager->getPage() ?>;
max_page = <?php echo $pager->getLastPage() ?>;
jQuery('#list').trigger('watchScroll');
//]]>
</script>