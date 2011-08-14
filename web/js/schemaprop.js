function updateUri()
{
   var domainField = $('schema_uri');
   var tokenField = $('schema_property_name');
   var tokenValue = $('schema_property_name').value;
   var uriField = $('schema_property_uri');
   var nextField = $('schema_property_definition');
   var updateIt;
   if('' != tokenValue && tokenValue != tokenField.defaultValue)
   {
      updateIt = confirm("Automatically update the URI based on your changes?");
   }
   if(updateIt)
   {
      uriField.value = domainField.value + tokenValue;
      tokenField.defaultValue = tokenValue;
      uriField.select();
   }
};