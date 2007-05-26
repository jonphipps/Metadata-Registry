<h1>
<?php
  $vocabulary = $sf_user->getCurrentVocabulary();
  echo link_to('Vocabulary:', 'vocabulary/list');
  if ($vocabulary)
  {
    echo link_to($vocabulary->getName(), 'vocabulary/show?id=' . $vocabulary->getId());
    echo "<br />&nbsp;&nbsp;" . link_to('Concepts: ', '/concept/list?vocabulary_id=' . $vocabulary->getID());
  }
  $concept = $sf_user->getCurrentConcept();
  if ($concept)
  {
    echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID());
  }

  echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;" . link_to('Properties:', '/conceptprop/list?concept_id=' . $concept->getID()) . "&nbsp;";

  if ($sf_params->get('id'))
  {
    echo "Editing&nbsp;" .  $concept_property->getSkosPropertyName();
  }
  else
  {
    echo "Creating New Property";
  }
?>
</h1>
