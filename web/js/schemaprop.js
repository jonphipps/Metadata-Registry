function updateUri () {
  var domainField = $('schema_uri');
  var tokenField = $('schema_property_name');
  var tokenValue = $('schema_property_name').value;
  var uriField = $('schema_property_lexical_uri');
  var nextField = $('schema_property_definition');
  var updateIt;
  if ('' != tokenValue && tokenValue != tokenField.defaultValue) {
    updateIt = confirm("Automatically update the URI based on your changes?");
  }
  if (updateIt) {
    uriField.value = domainField.value + tokenValue;
    tokenField.defaultValue = tokenValue;
    uriField.select();
  }
}

var $jq = jQuery;

Event.observe(window, 'load', function () {

  var $selProperties = $jq("select#schema_property_is_subproperty_of"),
      $selClasses = $jq('select#schema_property_is_subclass_of'),
      $ParentUri = $('schema_property_parent_uri'),
      $parentValue;

  var updateParent = function (sel) {
    $ParentUri.value = sel.select2("data").text.split("--")[1].trim();
    $parentValue = $ParentUri.value;
    $ParentUri.focus();
  }

  $selProperties.select2({
    placeholder: "Select from properties of Element Sets for which you are a maintainer",
    allowClear: true
  });

  $selClasses.select2({
    placeholder: "Select from classes of Element Sets for which you are a maintainer",
    allowClear: true
  });

  $selProperties.on("change", function () {
    var _this = $jq("select#schema_property_is_subproperty_of");
    updateParent(_this)
  });

  $selClasses.on("change", function () {
    var _this = $jq("select#schema_property_is_subclass_of");
    updateParent(_this)
  });

  $ParentUri.observe('blur', function () {
    if ($parentValue !== $ParentUri.value) {
      $selProperties.select2("val", "", false);
      $selProperties.select2({
        placeholder: "Selection was cleared because you edited the URI directly"
      });
      $selClasses.select2("val", "", false);
      $selClasses.select2({
        placeholder: "Selection was cleared because you edited the URI directly"
      });
    }
  })

});
