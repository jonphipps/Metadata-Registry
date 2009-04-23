<br/>
<strong><?php echo link_to('Manage application menus','sfBreadNavAdmin/list') ?></strong>
<br/>
<br/>
<?php if (isset($nomenu)) {echo "Go to menu page to create a menu for the desired application"; return;}?>
<?php include_partial ('select_menu', array('form' => $scopeform)); ?>
<?php 

if (isset($freshinstall)) {
  echo "<br/><br/>";
  echo link_to('Start By Creating A Home Page/Root', 'sfBreadNavAdmin/edithome?scope=' . $scope);
  return;
  }else{
    if (!is_null($scope)) {
         include_partial ('page_tree',array('scope' => $scope));
    }
  }
    
?>
<style type="text/css"> 
#breadnavtreetable tr.odd { background-color: #fff; padding: 1em; } 
#breadnavtreetable tr.even { background-color: #ccc; padding: 1em; }
#breadnavtreetable td {padding-left: 1em; padding-right: 1em;}
</style> 
<br/>
<?php  if (isset($edit)){echo '<h3>Editing: '. $form->getDefault('page') .'</h3>'; }?>
<form action="<?php echo url_for('sfBreadNavAdmin/index?scope='.$scope) ?>" method='POST'>
<table style="text-align:left;">
<?php echo $form ?>
<tr>
<td></td><td><input type='submit' value='<?php
if (isset ($edit)) {echo 'Update Page'; }else{echo 'Add Page';} 
?>' /></td>
</tr>
</table>
</form>
<?php if (isset($edit) ):?>
<br/>
<a href='<?php echo url_for('sfBreadNavAdmin/index?scope='.$scope) ?>'>New page</a>
<br/>
<br/>
<form method="post" action='<?php echo url_for('sfBreadNavAdmin/deletepage?pageid=' . $form->getDefault('id') . "&scope=" . $scope );?>'>
<input type='submit' value="delete" onclick="if (!confirm('Are you sure?')){return false;}">  
</form>

<?php endif; ?>