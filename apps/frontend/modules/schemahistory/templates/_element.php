<?php
//debugbreak();
   $element = $schema_property_element_history->getSchemaPropertyElement();
   if ($element)
   {
      echo link_to($element, '/schemapropel/show?id=' . $element->getId());
   }
?>