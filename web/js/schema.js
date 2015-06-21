function updateUri()
{
   var domainField = $('base_domain');
   var tokenField = $('schema_token');
   var uriField = $('schema_uri');
   var updateIt = true;
   if('' != tokenField.value && uriField.value != domainField.value + tokenField.value)
   {
      updateIt = confirm("Automatically update the Namespace URI based on your changes?");
   }
   if(updateIt)
   {
      uriField.value = domainField.value + tokenField.value
   }
};


var $jq = jQuery.noConflict();
$jq(document).ready(function () {

var $selLanguages = $jq("select#schema_languages")
var $selLang      = $jq('select#schema_language');

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
