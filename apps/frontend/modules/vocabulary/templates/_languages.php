<?php  $languages = '';
if (is_array($vocabulary->getLanguages())) {
  foreach ($vocabulary->getLanguages() as $language) {
    $languages .= format_language($language) . ", ";
  }
  $languages = rtrim($languages, ", ");
}
echo $languages ?>
