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
};