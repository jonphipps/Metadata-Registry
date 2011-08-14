<div id="panel_admin">
<div class="subcontent-unit-border">
  <div class="round-border-topleft"></div>
  <div class="round-border-topright"></div>
  <h1><?php echo __('Administration') ?></h1>
  <ul>
    <li><?php echo link_to(__('All users'), 'user/list') ?> (<?php echo UserPeer::getUsersCount() ?>)</li>
    <li><?php echo link_to(__('maintainer candidates'), 'administrator/moderatorCandidates') ?> (<?php echo UserPeer::getModeratorCandidatesCount() ?>)</li>
    <li><?php echo link_to(__('maintainer list'), 'administrator/maintainers') ?></li>
    <li><?php echo link_to(__('administrator list'), 'administrator/administrators') ?></li>
    <li><?php echo link_to(__('unreviewed resources'), 'administrator/newresources') ?> (<?php echo UserPeer::getProblematicUsersCount() ?>)</li>
  </ul>
</div>
</div>
