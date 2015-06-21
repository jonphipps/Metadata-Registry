<?php  $languages = '';
if (is_array($schema->getLanguages())) {
  foreach ($schema->getLanguages() as $language) {
    $languages .= format_language($language) . ", ";
  }
  $languages = rtrim($languages, ", ");
}
echo $languages ?>
