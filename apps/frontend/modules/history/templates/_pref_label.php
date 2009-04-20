<?php
//debugbreak();
   $concept = $concept_property_history->getConceptRelatedByConceptId();
   if ($concept)
   {
      echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $concept->getID());
   }
?>