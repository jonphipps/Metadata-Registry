<?php  $languagesOut = '';
  /** @var $vocabulary_has_user VocabularyHasUser */
  $languages = $vocabulary_has_user->getLanguages();
  if (is_array($languages)) {
  foreach ($languages as $language) {
    $languagesOut .= format_language($language) . ", ";
  }
  $languagesOut = rtrim($languagesOut, ", ");
}
echo $languagesOut ?>
