function updateUri () {
  var domainField = $('vocabulary_base_domain');
  var tokenField = $('vocabulary_token');
  var uriField = $('vocabulary_uri');
  var updateIt = true;
  if (uriField.value != domainField.value + tokenField.value) {
    updateIt = confirm("Automatically update the URI based on your changes?");
  }
  if (updateIt) {
    uriField.value = domainField.value + tokenField.value;
  }
}

var $jq = jQuery.noConflict();
$jq(document).ready(function () {

  $jq("select#vocabulary_languages").select2({
    placeholder: "Select all available Language(s)",
    allowClear: true
  });

  $jq("select#vocabulary_language").select2({
    placeholder: "Select a Default Language",
    allowClear: true
  });

  $jq("select#vocabulary_languages").on("change",
      function (e) {
        var data = $jq("select#vocabulary_languages").select2("data");
        var $selLang = $jq('select#vocabulary_language');
        var savedVal = $selLang.select2("val");
        $selLang[0].options.length = 0;
        $selLang.select2("val", "");
        $jq.each(data, function (index, value) {
          $selLang.append('<option value="' + data[index].id + '">' + data[index].text + '</option>');
          if (data[index].id == savedVal) {
            $selLang.select2("val", savedVal)
          }
        });
      });
});
