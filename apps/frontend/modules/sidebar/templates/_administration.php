<div id="panel_admin">
<div class="subcontent-unit-border">
  <div class="round-border-topleft"></div>
  <div class="round-border-topright"></div>
  <h1><?php echo __s('Administration') ?></h1>
  <ul>
    <li><?php echo sf_link_to(__s('All users'), 'user/list') ?> (<?php echo UserPeer::getUsersCount() ?>)</li>
    <li><?php echo sf_link_to(__s('maintainer candidates'), 'administrator/moderatorCandidates') ?> (<?php echo UserPeer::getModeratorCandidatesCount() ?>)</li>
    <li><?php echo sf_link_to(__s('maintainer list'), 'administrator/maintainers') ?></li>
    <li><?php echo sf_link_to(__s('administrator list'), 'administrator/administrators') ?></li>
    <li><?php echo sf_link_to(__s('unreviewed resources'), 'administrator/newresources') ?> (<?php echo UserPeer::getProblematicUsersCount() ?>)</li>
  </ul>
</div>
</div>
