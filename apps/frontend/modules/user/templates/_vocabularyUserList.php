<table cellspacing="0" class="sf_admin_list">
   <tr>
      <th>Name</th>
      <th>Administrator</th>
      <th>Maintainer</th>
      <th>Registrar</th>
   </tr>
<?php foreach($users as $user): ?>
  <tr>
    <td>
      <?php $objUser = $user->getUser(); echo link_to($objUser->getUser(), 'user/show?id=' . $objUser->getId()); ?>
    </td>
    <td>
      <?php echo $user->getIsAdminFor() ? image_tag(sfConfig::get('sf_admin_web_dir').'/images/tick.png') : '&nbsp;' ?>
    </td>
    <td>
      <?php echo $user->getIsMaintainerFor() ? image_tag(sfConfig::get('sf_admin_web_dir').'/images/tick.png') : '&nbsp;' ?>
    </td>
    <td>
      <?php echo $user->getIsRegistrarFor() ? image_tag(sfConfig::get('sf_admin_web_dir').'/images/tick.png') : '&nbsp;' ?>
    </td>
  </tr>
<?php endforeach ?>
</table>