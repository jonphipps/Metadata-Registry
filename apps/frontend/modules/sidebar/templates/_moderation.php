<?php if ($sf_user->hasCredential(array (0 => 'moderator' ))): ?>
  <h2><?php echo __s('moderation') ?></h2>

  <ul>
    <li><?php echo sf_link_to(__s('reported questions'), 'moderator/reportedQuestions') ?> (<?php echo QuestionPeer::getReportCount() ?>)</li>
    <li><?php echo sf_link_to(__s('reported answers'), 'moderator/reportedAnswers') ?> (<?php echo AnswerPeer::getReportCount() ?>)</li>
    <li><?php echo sf_link_to(__s('unpopular tags'), 'moderator/unpopularTags') ?></li>
  </ul>
<?php endif ?>
