var $jq = jQuery.noConflict();
$jq(document).ready(function () {

  var $selLang = $jq('select#addLanguage');

  $selLang.select2({
    placeholder: "Select an Additional Language (optional)",
    allowClear: true
  });

});
