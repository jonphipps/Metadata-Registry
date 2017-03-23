<?php if ($sf_user->hasCredential(array (0 => 'moderator' ))): ?>
  <?php if ($answer->getReports()): ?>
    &nbsp;[<?php echo __s('%1% reports', array('%1%' => $answer->getReports())) ?>]
    &nbsp;<?php echo sf_link_to('['.__s('reset reports').']', 'moderator/resetAnswerReports?id='.$answer->getId(), 'confirm='.__s('Are you sure you want to reset the report spam counter for this answer?')) ?>
  <?php endif ?>
  &nbsp;<?php echo sf_link_to('['.__s('delete answer').']', 'moderator/deleteAnswer?id='.$answer->getId(), 'confirm='.__s('Are you sure you want to delete this answer?')) ?>
<?php endif ?>
