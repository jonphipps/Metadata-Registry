function updateUri()
{
   var domainField = $('schema_uri');
   var tokenField = $('schema_property_name');
   var uriField = $('schema_property_uri');
   var updateIt = true;
   if(uriField.value != domainField.value + tokenField.value)
   {
      updateIt = confirm("Automatically update the URI based on your changes?");
   }
   if(updateIt)
   {
      uriField.value = domainField.value + tokenField.value;
      uriField.select();
   }
};