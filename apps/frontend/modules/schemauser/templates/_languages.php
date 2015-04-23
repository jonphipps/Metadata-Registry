<?php  $languages = '';
  $languageArray  = $schema_has_user->getLanguages();
  if (is_array($languageArray)) {
    if (in_array("*", $languageArray)) {
      //get the data from the schema instead
      $languageArray = $schema_has_user->getLanguagesForSchema();
    }
    if (is_array($languageArray)) {

      foreach ($languageArray as $language) {
        $languages .= format_language($language) . ", ";
      }
      $languages = rtrim($languages, ", ");
    }
  }
  echo $languages ?>
