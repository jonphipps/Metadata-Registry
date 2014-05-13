var $jq = jQuery.noConflict();
$jq(document).ready(function () {

var $selLanguages = $jq("select#schema_has_user_languages")
var $selLang      = $jq('select#schema_has_user_default_language');

  $selLanguages.select2({
    placeholder: "Select all available Language(s)",
    allowClear: true
  });

  $selLang.select2({
    placeholder: "Select a Default Language",
    allowClear: true
  });

  $selLanguages.on("change",
      function (e) {
        var data = $selLanguages.select2("data");
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
