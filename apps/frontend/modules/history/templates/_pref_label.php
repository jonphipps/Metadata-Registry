<?php

   $concept = $concept_property_history->getConceptRelatedByConceptId();
   if ($concept)
   {
      echo sf_link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID());
   }
?>
