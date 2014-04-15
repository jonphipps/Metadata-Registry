<?php  $languages = '';
if (is_array($vocabulary_has_user->getLanguages())) {
  foreach ($vocabulary_has_user->getLanguages() as $language) {
    $languages .= format_language($language) . ", ";
  }
  $languages = rtrim($languages, ", ");
}
echo $languages ?>
