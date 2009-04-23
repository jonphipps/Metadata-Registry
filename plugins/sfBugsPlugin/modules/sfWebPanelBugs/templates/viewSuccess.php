<?php use_helper('Javascript'); ?>
<?php echo link_to_remote('Back to List', array('url'=>'sfWebPanelBugs/list?mod='.$module.'&act='.$action.'&app='.$app, 'update' => array('success' => 'sf_webpanel_bug_list')) ) ?>
<table>
	<tr>
		<td align="right"><strong>Title:</strong></td>
		<td align="left"><?php echo $bug->getTitle() ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Description:</strong></td>
		<td align="left"><?php echo nl2br($bug->getDescription()) ?></td>
	</tr>
</table>