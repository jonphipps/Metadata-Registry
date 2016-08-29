var $jq = jQuery.noConflict();
$jq(document).ready(function () {

  var $selLanguages = $jq("select#vocabulary_has_user_languages")
  var $selLang = $jq('select#vocabulary_has_user_default_language');

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
        var selVal = $selLanguages.select2("val")[0]
        var savedVal = $selLang.select2("val");
        $selLang[0].options.length = 0;
        $selLang.select2("val", "");
        if ("*" === selVal) {
          $selLang[0].innerHTML = $selLanguages[0].innerHTML
          $selLang[0].options[0].remove();
          $selLanguages.select2("val", ["*"]);
          $selLanguages.select2({ maximumSelectionSize: 1 });
        } else {
          $selLanguages.select2({ maximumSelectionSize: -1 });
          $jq.each(data, function (index, value) {
            $selLang.append('<option value="' + data[index].id + '">' + data[index].text + '</option>');
            if (data[index].id == savedVal) {
              $selLang.select2("val", savedVal)
            }
          })
        }
      });
});
