<?php $vocabulary = $sf_user->getCurrentVocabulary() ?>
<?php if ($vocabulary): ?>
   <h1>Showing &nbsp;<?php echo $vocabulary->getName() ?></h1>
   <h2>&nbsp;<?php echo link_to('Detail', 'vocabulary/show?id=' . $vocabulary->getId()) ?>&nbsp;&nbsp;&nbsp;Concepts&nbsp;&nbsp;&nbsp;<a href="#">History</a>&nbsp;&nbsp;&nbsp;<a href="#">Versions</a></h2>
<?php endif; ?>

