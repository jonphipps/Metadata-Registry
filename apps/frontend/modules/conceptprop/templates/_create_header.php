<h1>
  Add new property <br />for <?php $action = $sf_context->getActionStack()->getLastEntry()->getActionInstance(); echo link_to('Concept', 'concept/list?vocabulary_id=' . $action->getVocabularyID()) ?>:
  <?php echo link_to($action->concept->getPrefLabel(), 'concept/show?id=' . $action->concept->getId()) ?><br />
  in <?php echo link_to('Vocabulary', 'vocabulary/list') ?>:
  <?php echo link_to($action->getVocabularyName(), 'vocabulary/show?id=' . $action->getVocabularyID()) ?>
</h1>

