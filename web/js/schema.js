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