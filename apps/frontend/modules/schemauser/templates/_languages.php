<?php  $languages = '';
if (is_array($schema_has_user->getLanguages())) {
  foreach ($schema_has_user->getLanguages() as $language) {
    $languages .= format_language($language) . ", ";
  }
  $languages = rtrim($languages, ", ");
}
echo $languages ?>
