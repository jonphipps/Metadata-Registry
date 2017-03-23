<?php

   $property = $schema_property_element_history->getSchemaPropertyRelatedBySchemaPropertyId();
   if ($property)
   {
      echo sf_link_to($property, '/schemaprop/show?id=' . $property->getId());
   }
?>
