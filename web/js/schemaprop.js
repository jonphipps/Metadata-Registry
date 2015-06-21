function updateUri () {
  var domainField = $('schema_uri');
  var labelField = $('schema_property_label');
  var labelValue = labelField.value;
  var tokenField = $('schema_property_name');
  var tokenValue = tokenField.value;
  var uriField = $('schema_property_lexical_alias');
  var updateIt;
  if ('' != labelValue && labelValue != labelField.defaultValue) {
    updateIt = confirm("Automatically update the Name and Lexical Alias based on your changes?");
  }
  if (updateIt) {
    tokenValue = S(labelField.value).camelize().s;
    uriField.value = domainField.value + tokenValue;
    labelField.defaultValue = labelValue;
    tokenField.value = tokenValue;
    tokenField.select();
  }
}

var $jq = jQuery;

Event.observe(window, 'load', function () {

  var $selProperties = $jq("select#schema_property_is_subproperty_of"),
      $selClasses = $jq('select#schema_property_is_subclass_of'),
      $ParentUri = $('schema_property_parent_uri'),
      $parentValue;

  var updateParent = function (sel) {
    if (sel.select2("val") !== '') {
      $ParentUri.value = sel.select2("data").text.split("--")[1].trim();
      $parentValue = $ParentUri.value;
    } else {
      $ParentUri.value = '';
    }
    $ParentUri.focus();
  };

  $selProperties.select2({
    allowClear: true,
    placeholder: "Select from properties of Element Sets for which you are a maintainer"
  });

  $selClasses.select2({
    allowClear: true,
    placeholder: "Select from classes of Element Sets for which you are a maintainer"
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
