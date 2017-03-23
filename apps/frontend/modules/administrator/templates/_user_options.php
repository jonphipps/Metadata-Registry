<?php if ($sf_user->hasCredential(array (0 => 'administrator' ))): ?>
<div class="options">
  <?php if ($subscriber->getDeletions()): ?>
    [<?php echo __s('%1% contributions removed', array('%1%' => $subscriber->getDeletions())) ?>]
  <?php endif ?>

  &nbsp;
  <?php if ($subscriber->getIsModerator()): ?>
    <?php echo sf_link_to('['.__s('moderator').' -]', 'administrator/removeModerator?nickname='.$subscriber->getNickname()) ?>
  <?php else: ?>
    <?php echo sf_link_to('['.__s('moderator').' +]', 'administrator/promoteModerator?nickname='.$subscriber->getNickname()) ?>
  <?php endif ?>

  &nbsp;
  <?php if ($subscriber->getIsAdministrator()): ?>
    <?php echo sf_link_to('['.__s('administrator').' -]', 'administrator/removeAdministrator?nickname='.$subscriber->getNickname()) ?>
  <?php else: ?>
    <?php echo sf_link_to('['.__s('administrator').' +]', 'administrator/promoteAdministrator?nickname='.$subscriber->getNickname()) ?>
  <?php endif ?>

  &nbsp;<?php echo sf_link_to('['.__s('delete user').']', 'administrator/deleteUser?nickname='.$subscriber->getNickname(), 'confirm='.__s('Are you sure you want to delete this user and all his contributions?')) ?>
</div>

<br />

<?php endif ?>
