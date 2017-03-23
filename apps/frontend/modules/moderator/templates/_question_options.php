<?php if ($sf_user->hasCredential(array (0 => 'moderator' ))): ?>
  <?php if ($question->getReports()): ?>
    &nbsp;[<?php echo __s('%1% reports', array('%1%' => $question->getReports())) ?>]
    &nbsp;<?php echo sf_link_to('['.__s('reset reports').']', 'moderator/resetQuestionReports?stripped_title='.$question->getStrippedTitle(), 'confirm='.__s('Are you sure you want to reset the report spam counter for this question?')) ?>
  <?php endif ?>
  &nbsp;<?php echo sf_link_to('['.__s('delete question').']', 'moderator/deleteQuestion?stripped_title='.$question->getStrippedTitle(), 'confirm='.__s('Are you sure you want to delete this question?')) ?>
<?php endif ?>
