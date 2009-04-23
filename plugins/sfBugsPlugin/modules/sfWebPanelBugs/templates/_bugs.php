<?php use_helper('Javascript'); ?>
<?php
$opened = true;
?>
<table>
	<tr><td colspan="2"><h1>Open bugs</h1></td></tr>
	<?php foreach ($bugs AS $bug): ?>
	<?php
		if ( $bug->getSolved() == 1 && $opened ) {
			$opened = false;
			echo '<tr><td colspan="2"><h1>Closed bugs</h1></td></tr>';
		}
	?>
	<tr><td style="padding-left:20px; width:280px;"><?php echo $bug->getTitle(); ?></td><td align="right" style="padding-left:20px;">
	<?php echo link_to_remote('View', array('url'=>'sfWebPanelBugs/view?id=' . $bug->getId().'&mod='.$module.'&act='.$action.'&app='.$app, 'update' => array('success' => 'sf_webpanel_bug_list'))) ?>
	<?php
		if ( $bug->getSolved() == 0 ) {
			echo link_to_remote('Close', array('url'=>'sfWebPanelBugs/solve?id=' . $bug->getId().'&mod='.$module.'&act='.$action.'&app='.$app, 'update' => array('success' => 'sf_webpanel_bug_list')));
		} else {
			echo link_to_remote('Re-Open', array('url'=>'sfWebPanelBugs/reopen?id=' . $bug->getId().'&mod='.$module.'&act='.$action.'&app='.$app, 'update' => array('success' => 'sf_webpanel_bug_list')));
		}
	?>
	<?php echo link_to_remote('Remove', array('url'=>'sfWebPanelBugs/delete?id=' . $bug->getId().'&mod='.$module.'&act='.$action.'&app='.$app, 'update' => array('success' => 'sf_webpanel_bug_list')), array('confirm' => 'Are you sure you want to delete this bug?')) ?></td></tr>
	<?php endforeach; ?>
</table>