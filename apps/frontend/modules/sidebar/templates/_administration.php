<?php if ($sf_user->hasCredential(array (0 => 'administrator' ))): ?>
<div id="panel_admin">
  <h2><?php echo __('administration') ?></h2>

  <ul>
    <li><?php echo link_to(__('maintainer candidates'), 'administrator/moderatorCandidates') ?> (<?php echo UserPeer::getModeratorCandidatesCount() ?>)</li>
    <li><?php echo link_to(__('maintainer list'), 'administrator/maintainers') ?></li>
    <li><?php echo link_to(__('administrator list'), 'administrator/administrators') ?></li>
    <li><?php echo link_to(__('unreviewed resources'), 'administrator/newresources') ?> (<?php echo UserPeer::getProblematicUsersCount() ?>)</li>
  </ul>
</div>
  <?php endif ?>