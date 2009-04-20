<?php
//debugbreak();
   $property = $schema_property_element_history->getSchemaPropertyRelatedBySchemaPropertyId();
   if ($property)
   {
      echo link_to($property, '/schemaprop/show?id=' . $property->getId());
   }
?>