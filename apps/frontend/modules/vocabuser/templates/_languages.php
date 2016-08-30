<?php $languages = '';
$languageArray   = $vocabulary_has_user->getLanguages();
if (is_array($languageArray)) {
    if (in_array("*", $languageArray)) {
        //get the data from the vocabulary instead
        $languageArray = $vocabulary_has_user->getLanguagesForVocabulary();
    }
    if (is_array($languageArray)) {

        foreach ($languageArray as $language) {
            $languages .= format_language($language) . ", ";
        }
        $languages = rtrim($languages, ", ");
    }
}
echo $languages ?>
