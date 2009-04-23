<?php use_helper('Javascript'); ?>
<style type="text/css">@import url(<?php echo stylesheet_path('../sfBugsPlugin/css/sfwebpanel_bugs') ?>);</style>

<script type="text/javascript">
window.sfWebpanelBugClear = function() {
	document.getElementById('sf_webpanel_bug_description').value = '';
	document.getElementById('sf_webpanel_bug_name').value = '';
}
</script>

<form id="sf_webpanel_bug_form" name="sf_webpanel_bug_form">
<table class="sf_webpanel_send_table">
	<tbody>
	<tr>
		<td align="right">Title:</td>
		<td><input type="text" name="sf_webpanel_bug_name" id="sf_webpanel_bug_name" /></td>
	<tr>
		<td align="right">Description:</td>
		<td><textarea name="sf_webpanel_bug_description" id="sf_webpanel_bug_description"></textarea></td>
	</tr>
	<tr>
		<td align="right" colspan="2"><?php echo link_to_remote('Send', array('url'=>'sfWebPanelBugs/add?mod='.$module.'&act='.$action.'&app='.$app, 'update' => array('success' => 'sf_webpanel_bug_list'), 'with'=>'{description: document.getElementById(\'sf_webpanel_bug_description\').value, title: document.getElementById(\'sf_webpanel_bug_name\').value, uri: "' . $url . '"}', 'after' => 'sfWebpanelBugClear()')) ?></td>
	</tr>
	</tbody>
</table>
</form>

<div id="sf_webpanel_bug_list">
<?php include_partial('sfWebPanelBugs/bugs', array('bugs'=>$bugs, 'module'=>$module, 'action'=>$action, 'app'=>$app)); ?>
</div>