<?php
  class myActionTools
  {
  /**
  * update the currently set filters
  *
  * @return none
  * @param  string $filter the name of the filtet, typically from the query string
  * @param  string $value the value of the filter
  * @param  string $namespace the local filter namespace ('sf_admin/$namespace/filters')
  */
  public static function updateAdminFilters($attributeHolder, $filter, $value, $namespace)
  {
    $filters = $attributeHolder->get('filters', null, "sf_admin/$namespace/filters");
    $filters[$filter] = $value;

    $attributeHolder->removeNamespace("sf_admin/$namespace/filters");
    $attributeHolder->add($filters, "sf_admin/$namespace/filters");

    return;
  }
  }
?>