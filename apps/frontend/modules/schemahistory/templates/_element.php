<?php
   $element = $schema_property_element_history->getSchemaPropertyElement();
   if ($element)
   {
      echo sf_link_to($element, '/schemapropel/show?id=' . $element->getId());
   }
?>
