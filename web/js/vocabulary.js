function updateUri () {
  var domainField = $('vocabulary_base_domain');
  var tokenField = $('vocabulary_token');
  var uriField = $('vocabulary_uri');
  var updateIt = true;
  if (uriField.value != domainField.value + tokenField.value) {
    updateIt = confirm("Automatically update the URI based on your changes?");
  }
  if (updateIt) {
    uriField.value = domainField.value + tokenField.value
  }
}

var $jq = jQuery.noConflict();
$jq(document).ready(function () {
  $jq("#vocabulary_languages").select2({
    placeholder: "Select a Language",
    allowClear: true
  });
  $jq("#vocabulary_languages").on("change",
      function () {
        $jq("#vocabulary_language").select2("data",
            $jq("#vocabulary_languages").select2("data"))
      });
});
