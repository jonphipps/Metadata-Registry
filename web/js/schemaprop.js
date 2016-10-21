function updateUri () {
  var domainField = $('#schema_uri');
  var labelField = $('#schema_property_label');
  var labelValue = labelField.val();
  var tokenField = $('#schema_property_name');
  var tokenValue = tokenField.val();
  var uriField = $('#schema_property_lexical_alias');
  var updateIt;
  if ('' != labelValue && labelValue != labelField.defaultValue) {
    updateIt = confirm("Automatically update the Name and Lexical Alias based on your changes?");
  }
  if (updateIt) {
    tokenValue = S(labelField.val()).camelize().s;
    uriField.val(domainField.val() + tokenValue);
    labelField.defaultValue = labelValue;
    tokenField.val(tokenValue);
    tokenField.select();
  }
}

$(document).ready(function () {

  var $selProperties = $("#schema_property_is_subproperty_of"),
      $selClasses = $('#schema_property_is_subclass_of'),
      $ParentUri = $('#schema_property_parent_uri'),
      $parentValue;

  var updateParent = function (sel) {
    if (sel.select2("val") !== '') {
      $ParentUri.val(sel.select2("data").text.split("--")[1].trim());
      $parentValue = $ParentUri.val();
    } else {
      $ParentUri.val('');
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
    var _this = $("#schema_property_is_subproperty_of");
    updateParent(_this)
  });

  $selClasses.on("change", function () {
    var _this = $("#schema_property_is_subclass_of");
    updateParent(_this)
  });

  $ParentUri.on('blur', function () {
    if ($parentValue !== $ParentUri.val()) {
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
