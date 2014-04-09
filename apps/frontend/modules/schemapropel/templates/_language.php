<?php /** @var $sf_user MyUser */
$languages = $sf_user->getAttribute("languages", null);
$language = $schema_property_element->getLanguage();
$CurrentLanguage = $language ? $language : $sf_user->getAttribute("CurrentLanguage", null);
//if the current culture setting isn't in the allowed list, we reset the culture to the default
echo select_language_tag('schema_property_element[language]', $CurrentLanguage, array('id' => 'language', "languages" => $languages)); ?>
